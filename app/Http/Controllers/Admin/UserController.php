<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\PermissionModule;
use App\Models\UserPermission;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_active' => ['boolean'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active ?? true,
        ]);

        if ($request->filled('master_password')) {
            $user->update(['master_password' => Hash::make($request->master_password)]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'is_active' => ['boolean'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => $request->is_active ?? true,
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => ['confirmed', Rules\Password::defaults()]]);
            $user->update(['password' => Hash::make($request->password)]);
        }

        if ($request->filled('master_password')) {
            $user->update(['master_password' => Hash::make($request->master_password)]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete yourself!');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

    public function permissions(User $user)
    {
        // Get all modules and actions
        $modules = PermissionModule::with('actions')->get();
        
        // Get user's current permissions
        $userPermissions = $user->permissionActions()->pluck('permission_actions.id')->toArray();
        
        return view('admin.users.permissions', compact('user', 'modules', 'userPermissions'));
    }

    public function updatePermissions(Request $request, User $user)
    {
        $actionIds = $request->input('permissions', []);
        
        // Remove all current permissions
        UserPermission::where('user_id', $user->id)->delete();
        
        // Insert new ones
        $inserts = [];
        foreach ($actionIds as $id) {
            $inserts[] = [
                'user_id' => $user->id,
                'permission_action_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        if (count($inserts) > 0) {
            UserPermission::insert($inserts);
        }
        
        return redirect()->route('admin.users.index')->with('success', 'Permissions updated successfully.');
    }
}

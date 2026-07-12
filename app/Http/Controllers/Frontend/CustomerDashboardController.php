<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\CustomerAddress;
use Illuminate\Validation\Rule;

class CustomerDashboardController extends Controller
{
    public function dashboard()
    {
        return view('frontend.customer.dashboard');
    }

    public function updateProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        
        $request->validate([
            'first_name' => 'required|string|max:125',
            'last_name' => 'required|string|max:125',
            'phone' => 'nullable|digits_between:1,12',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->only('first_name', 'last_name', 'phone');

        if ($request->hasFile('image')) {
            if ($customer->image && Storage::disk('public')->exists($customer->image)) {
                Storage::disk('public')->delete($customer->image);
            }
            $imagePath = $request->file('image')->store('customers', 'public');
            $data['image'] = $imagePath;
        }

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $customer->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:home,work,other',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
        ]);

        Auth::guard('customer')->user()->addresses()->create($request->all());

        return back()->with('success', 'Address added successfully.');
    }

    public function destroyAddress(CustomerAddress $address)
    {
        if ($address->customer_id !== Auth::guard('customer')->id()) {
            abort(403);
        }

        $address->delete();

        return back()->with('success', 'Address removed successfully.');
    }
}

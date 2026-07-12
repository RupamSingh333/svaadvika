<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(20);
        return view('admin.customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        $customer->load(['addresses', 'loginHistory']);
        return view('admin.customers.show', compact('customer'));
    }

    public function toggleBlock(Customer $customer)
    {
        $customer->is_blocked = !$customer->is_blocked;
        $customer->save();
        
        $status = $customer->is_blocked ? 'blocked' : 'unblocked';
        return back()->with('success', "Customer has been {$status} successfully.");
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'first_name' => 'required|string|max:125',
            'last_name' => 'required|string|max:125',
            'email' => 'required|string|email|max:255|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('first_name', 'last_name', 'email', 'phone');

        if ($request->hasFile('image')) {
            if ($customer->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($customer->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($customer->image);
            }
            $data['image'] = $request->file('image')->store('customers', 'public');
        }

        $customer->update($data);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $customer->update(['password' => bcrypt($request->password)]);
        }

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully.');
    }
}

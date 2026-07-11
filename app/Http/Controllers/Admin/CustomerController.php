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

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tax;

class TaxController extends Controller
{
    public function index()
    {
        $taxes = Tax::latest()->paginate(10);
        return view('admin.taxes.index', compact('taxes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:taxes',
            'percentage' => 'required|numeric|min:0|max:100',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Tax::create($request->all());

        return redirect()->route('admin.taxes.index')->with('success', 'Tax created successfully.');
    }

    public function update(Request $request, Tax $tax)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:taxes,name,' . $tax->id,
            'percentage' => 'required|numeric|min:0|max:100',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $tax->update($request->all());

        return redirect()->route('admin.taxes.index')->with('success', 'Tax updated successfully.');
    }

    public function destroy(Tax $tax)
    {
        $tax->delete();
        return redirect()->route('admin.taxes.index')->with('success', 'Tax deleted successfully.');
    }
}

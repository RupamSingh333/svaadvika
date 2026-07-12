<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliverySetting;

class DeliverySettingController extends Controller
{
    public function index()
    {
        $setting = DeliverySetting::first();
        if (!$setting) {
            $setting = DeliverySetting::create([
                'delivery_type' => 'Fixed Charge',
                'fixed_charge' => 0,
                'free_delivery_above' => 0,
                'minimum_order' => 0,
                'status' => 'active'
            ]);
        }
        
        return view('admin.delivery_settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'delivery_type' => 'required|string',
            'fixed_charge' => 'required|numeric|min:0',
            'free_delivery_above' => 'required|numeric|min:0',
            'minimum_order' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $setting = DeliverySetting::first();
        if ($setting) {
            $setting->update($request->all());
        } else {
            DeliverySetting::create($request->all());
        }

        return redirect()->route('admin.delivery-settings.index')->with('success', 'Delivery settings updated successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', '_method', 'site_logo');
        
        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'site_logo'], ['value' => $path, 'group' => 'general']);
        }
        
        foreach ($data as $key => $value) {
            $group = 'general';
            if (in_array($key, ['contact_email', 'contact_phone', 'whatsapp_number', 'address', 'google_map_url'])) {
                $group = 'contact';
            } elseif (in_array($key, ['facebook_url', 'instagram_url', 'twitter_url', 'youtube_url', 'pinterest_url'])) {
                $group = 'social';
            }
            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}

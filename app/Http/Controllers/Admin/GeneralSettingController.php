<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $settings = GeneralSetting::first() ?? new GeneralSetting();
        return view('admin.settings.general', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = GeneralSetting::first();
        if (!$settings) {
            $settings = new GeneralSetting();
        }

        $data = $request->validate([
            'site_title' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'hero_title' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'md_name' => 'nullable|string|max:255',
            'md_message' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'signature' => 'nullable|image|max:2048',
            'hero_image' => 'nullable|image|max:4096',
            'hero_video' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:51200',
        ]);

        if ($request->hasFile('logo')) {
            if ($settings->logo) {
                Storage::delete($settings->logo);
            }
            $data['logo'] = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('hero_image')) {
            if ($settings->hero_image) {
                Storage::delete($settings->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('settings', 'public');
        }

        if ($request->hasFile('hero_video')) {
            if ($settings->hero_video) {
                Storage::disk('public')->delete($settings->hero_video);
            }
            $data['hero_video'] = $request->file('hero_video')->store('settings/videos', 'public');
        }

        if ($request->hasFile('signature')) {
            if ($settings->signature) {
                Storage::delete($settings->signature);
            }
            $data['signature'] = $request->file('signature')->store('settings', 'public');
        }

        // Handle social links array
        $social_links = $request->only(['facebook', 'twitter', 'linkedin', 'instagram', 'youtube', 'whatsapp']);
        $data['social_links'] = array_filter($social_links);

        $settings->fill($data)->save();

        return back()->with('success', 'Settings updated successfully.');
    }
}

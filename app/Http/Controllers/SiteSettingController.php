<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSiteSettingRequest;
use App\Models\SiteSetting;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $this->authorize('admin', SiteSetting::class);
        $collection = SiteSetting::all();
        $setting = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return Inertia::render('Settings/SiteSettings/SiteSettings', [
            'setting' => $setting,
        ]);
    }

    public function update(UpdateSiteSettingRequest $request)
    {
        $this->authorize('admin', SiteSetting::class);
        $info = $request->except('');
        foreach ($info as $key => $value) {
            $setting = SiteSetting::firstWhere('key', $key);
            if ($setting) {
                SiteSetting::where('key', $key)->update(
                    [
                        'key' => $key,
                        'value' => $value
                    ]
                );
            } else {
                SiteSetting::create(
                    [
                        'key' => $key,
                        'value' => $value
                    ]
                );
            }
        }
        return Redirect::route('settings')->with('success', __('messages.updated'));
    }

    public function logo(Request $request)
    {
        $this->authorize('admin', SiteSetting::class);
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $setting = SiteSetting::firstWhere('key', 'logo');
            if ($setting) {
                $db_logo_image = public_path() . $setting->value;
                if (file_exists($db_logo_image)) {
                    @unlink($db_logo_image);
                }
                $setting->delete();
            };
            $logo_name = "/images/settings/" . time();

            // convert to webp 
            Image::make($request->file('file'))
                ->encode('webp', 100)
                ->resize(300, 300)
                ->save(public_path($logo_name . '.webp'));

            SiteSetting::create(
                [
                    'key' => 'logo',
                    'value' => $logo_name . '.webp'
                ]
            );
        }

        return Redirect::route('settings')->with('success', __('messages.updated'));
    }

    public function logo_remove()
    {
        $this->authorize('admin', SiteSetting::class);
        $setting = SiteSetting::firstWhere('key', 'logo');
        if ($setting) {
            $db_logo_image = public_path() . $setting->value;
            if (file_exists($db_logo_image)) {
                @unlink($db_logo_image);
            }
            $setting->delete();
        };
        return Redirect::route('settings')->with('success', __('messages.deleted'));
    }

    public function cover(Request $request)
    {
        $this->authorize('admin', SiteSetting::class);
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $setting = SiteSetting::firstWhere('key', 'cover');
            if ($setting) {
                $db_cover_image = public_path() . $setting->value;
                if (file_exists($db_cover_image)) {
                    @unlink($db_cover_image);
                }
                $setting->delete();
            };
            $cover_name = "/images/settings/" . time();

            // convert to webp 
            Image::make($request->file('file'))
                ->encode('webp', 100)
                ->save(public_path($cover_name . '.webp'));

            SiteSetting::create(
                [
                    'key' => 'cover',
                    'value' => $cover_name . '.webp'
                ]
            );
        }

        return Redirect::route('settings')->with('success', __('messages.updated'));
    }

    public function cover_remove()
    {
        $this->authorize('admin', SiteSetting::class);
        $setting = SiteSetting::firstWhere('key', 'cover');
        if ($setting) {
            $db_cover_image = public_path() . $setting->value;
            if (file_exists($db_cover_image)) {
                @unlink($db_cover_image);
            }
            $setting->delete();
        };
        return Redirect::route('settings')->with('success', __('messages.deleted'));
    }
}

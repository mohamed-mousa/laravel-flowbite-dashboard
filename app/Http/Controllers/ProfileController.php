<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        User::where('id', auth()->id())->update([
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return Redirect::route('profile.edit')->with('success', __('messages.updated'));
    }

    public function avatar(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        if ($request->hasFile('file')) {

            if (auth()->user()->avatar) {
                $db_avatar_image = public_path() . auth()->user()->avatar;
                if (file_exists($db_avatar_image)) {
                    @unlink($db_avatar_image);
                }
            };
            $avatar_name = "/images/avatar/" . time();

            // convert to webp 
            Image::make($request->file('file'))
                ->encode('webp', 100)
                ->resize(200, 200)
                ->save(public_path($avatar_name . '.webp'));

            User::where('id', auth()->id())->update([
                'avatar' => $avatar_name . '.webp',
            ]);
        }

        return Redirect::route('profile.edit')->with('success', __('messages.updated'));
    }

    public function avatar_remove()
    {
        if (auth()->user()->avatar) {
            $db_avatar_image = public_path() . auth()->user()->avatar;
            if (file_exists($db_avatar_image)) {
                @unlink($db_avatar_image);
            }
            User::where('id', auth()->id())->update([
                'avatar' => null,
            ]);
        };

        return Redirect::route('profile.edit')->with('success', __('messages.deleted'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function alert()
    {
        User::where('id', auth()->id())->update([
            'alert' => !auth()->user()->alert,
        ]);
        return Redirect::back()->with('success', __('messages.updated'));
    }

    public function notification()
    {
        User::where('id', auth()->id())->update([
            'notification' => !auth()->user()->notification,
        ]);
        return Redirect::back()->with('success', __('messages.updated'));
    }
}

<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Support\Facades\Session;
use App\Models\SiteSetting;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $lang = '';
        if (Session::has('locale')) {
            $lang = Session::get('locale');
        } else {
            $lang = 'ar';
        }

        $notification_count = 0;
        if (Auth()->user()) {
            $notification_count = Auth()->user()->unreadNotifications->count();
        }

        $collection = SiteSetting::all();
        $setting = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });

        return array_merge(parent::share($request), [
            'setting' => $setting,
            'user' => $request->user(),
            'notification_count' => $notification_count,
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'locale' =>  $lang,

        ]);
    }
}

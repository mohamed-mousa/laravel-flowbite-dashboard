<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        return Inertia::render('Notifications', [
            'notifications' => Auth()->user()->unreadNotifications,
        ]);
    }

    public function set($id)
    {
        DB::delete('delete from notifications where id = ?', [$id]);
    }

    public function set_all()
    {
        $user = auth()->user();
        $user->notifications()->delete();
    }
}

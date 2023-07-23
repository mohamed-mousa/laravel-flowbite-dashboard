<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as filtersRequest;

class UserController extends Controller
{
    public function index()
    {
        $filters = filtersRequest::all('keyword');
        return Inertia::render('Users', [
            'filters' => $filters,
            'users' => User::select('id', 'name', 'email', 'type', 'created_at')
                ->filter($filters)
                ->paginate(20)->onEachSide(0)
                ->withQueryString()
        ]);
        return Inertia::render('Users');
    }

    public function store(StoreUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'password' => Hash::make($request->password),
        ]);

        return Redirect::back()->with('success', __('messages.user.created'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}

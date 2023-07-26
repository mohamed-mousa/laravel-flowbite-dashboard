<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as filtersRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function index()
    {
        $filters = filtersRequest::all('keyword');
        return Inertia::render('Users', [
            'filters' => $filters,
            'users' => User::select('id', 'name', 'email', 'type', 'created_at', 'status')
                ->whereNot('id', auth()->user()->id)
                ->filter($filters)
                ->orderBy('created_at', 'DESC')
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

        return Redirect::back()->with('success', __('messages.created'));
    }


    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return Redirect::back()->with('success', __('messages.updated'));
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return Redirect::back()->with('success', __('messages.deleted'));
    }

    public function delete(Request $request)
    {
        if ($request->ids) {
            User::whereIn('id', Arr::wrap($request->ids))->delete();
        }
        return Redirect::back()->with('success', __('messages.deleted'));
    }
}

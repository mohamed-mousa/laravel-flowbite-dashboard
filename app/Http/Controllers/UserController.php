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
use App\Exports\UsersExport;
use App\Notifications\UserCreated;
use Illuminate\Support\Facades\Notification;

use PDF;

class UserController extends Controller
{
    public function clean_pagination($string)
    {
        $string = str_replace(' ', '', $string);
        $string = preg_replace('/[^0-9]/', '', $string);

        return preg_replace('/-+/', '', $string);
    }

    public function index(Request $request)
    {
        $filters = filtersRequest::all('keyword', 'p');
        return Inertia::render('Users', [
            'filters' => $filters,
            'users' => User::select('id', 'name', 'email', 'type', 'created_at', 'active', 'avatar', 'phone')
                ->whereNot('id', auth()->user()->id)
                ->filter($filters)
                ->orderBy('created_at', 'DESC')
                ->paginate($this->clean_pagination($request->p))->onEachSide(0)
                ->withQueryString()
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'active' => $request->active,
            'type' => $request->type,
            'password' => Hash::make($request->password),
        ]);

        $admins = User::where('type', 1)->get();
        Notification::send($admins, new UserCreated('users.new user created', $user->name, "/users?keyword={$user->name}&p=20"));

        return Redirect::back()->with('success', __('messages.created'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = $request->active;
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

    public function active($id)
    {
        $user = User::findOrFail($id);
        $user->active = !$user->active;
        $user->save();
        return Redirect::back()->with('success', __('messages.updated'));
    }

    public function delete(Request $request)
    {
        if ($request->ids) {
            User::whereIn('id', Arr::wrap($request->ids))->delete();
        }
        return Redirect::back()->with('success', __('messages.deleted'));
    }

    public function export(Request $request)
    {
        return (new UsersExport($request->data))->download('users.xlsx');
    }

    public function pdf(Request $request)
    {
        if ($request->data) {
            $users = User::select('id', 'email', 'name', 'phone')->whereIn('id', $request->data)->get();
        } else {
            $users = User::select('id', 'email', 'name', 'phone')->get();
        }

        $pdf = PDF::loadView('pdf.users', ['users' => $users]);

        return $pdf->download('users.pdf');
        // return $pdf->stream('users.pdf');

        // return (new UsersExport($request->data))->download('users.pdf', \Maatwebsite\Excel\Excel::MPDF);

    }
}

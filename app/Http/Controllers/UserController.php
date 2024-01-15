<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
            ->paginate(5);

        return view('pages.user.index', compact('users'), ['type_menu' => '']);
    }

    public function create()
    {
        return view('pages.user.create', ['type_menu' => '']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20',
            'roles' => ['required', Rule::in(['ADMIN', 'STAFF', 'USER'])],
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->name);
        $user->phone = $request->phone;
        $user->roles = $request->roles;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    public function show($id)
    {
        return view('pages.dashboard', ['type_menu' => '']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'), ['type_menu' => '']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|max:255',
            'phone' => 'string|max:20',
            'roles' => ['required', Rule::in(['ADMIN', 'STAFF', 'USER'])],
        ]);

        $data = $request->all();
        $user = User::findOrFail($id);
        if ($request->input('password')) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            $data['password'] = $user->password;
        }
        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}

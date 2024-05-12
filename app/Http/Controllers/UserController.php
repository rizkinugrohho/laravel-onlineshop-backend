<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //index
    public function index(Request $request)
    {
        $categories = Category::all();
        $role = $request->input('role');

        $usersQuery = User::query();
        if ($role) {
            $usersQuery->where('roles', $role);
        }

        // Query for filter searching
        $usersQuery->when($request->input('query'), function ($query, $queryValue) {
            return $query->where(function ($subQuery) use ($queryValue) {
                $subQuery->where('name', 'like', '%' . $queryValue . '%')
                    ->orWhere('email', 'like', '%' . $queryValue . '%');
            });
        });

        // Call paginate() in query created
        $users = $usersQuery->paginate(5);

        return view('pages.user.index', compact('users', 'categories'));
    }

    //create
    public function create()
    {
        return view('pages.user.create');
    }

    //store
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));
        User::create($data);
        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    //show
    public function show($id)
    {
        return view('pages.dashboard');
    }

    //edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    //update
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        //Check id password is not empty
        if ($request->input('password')) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            // if password is empty, then user the old password
            $data['password'] = $user->password;
        }
        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    //destroy
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted');
    }

}

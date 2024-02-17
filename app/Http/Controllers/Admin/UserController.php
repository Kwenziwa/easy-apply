<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Display a listing of users
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'national_id' => 'required|string|min:13|max:13|unique:users,national_id',
            'date_of_birth' => 'required|date|before:today',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone_number' => 'required|string|max:20|unique:users,phone_number',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        toastr()->success('User created successfully.', 'User Created');
        return redirect()->route('users.index');

    }

    // Display the specified user
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update the specified user in storage
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Include password validation only if it's being changed
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        }

        $user->update($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified user from storage
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}

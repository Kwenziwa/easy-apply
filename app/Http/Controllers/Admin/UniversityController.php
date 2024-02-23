<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Portfolio;
use App\Traits\FileUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller {
    use FileUploader; //add this trait
    // Display a listing of users
    public function index()
    {
        $users = User::where('type',2)->with('portfolio')->get();
        return view('admin.university.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('admin.university.create');
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'national_id' => 'required|string|min:13|max:13|unique:users,national_id',
            'date_of_birth' => 'required|date|before:today',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone_number' => 'required|string|max:20|unique:users,phone_number',
            'type' => 'required|in:0,1,2',
            'password' => ['required', 'string', 'min:8'],
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // If validation fails, redirect back to the form with the validation errors and old input
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->type == 2) {

            $validator_portfolio = Validator::make($request->all(), [
                'uni_email' => 'required|email|max:255',
                'uni_phone_number' => 'required|string|max:255',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'website_url' => 'required|url|max:255',
                'university_name' => 'required|string|max:255'
            ]);

            if ($validator_portfolio->fails()) {
                // If validation fails, redirect back to the form with the validation errors and old input
                return redirect()->back()->withErrors($validator_portfolio)->withInput();
            }
        }

        $validatedData = $validator->validated();
        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        if ($request->has('is_email_verified') && $request->is_email_verified == 1) {
            $user->email_verified_at = Carbon::now();
            $user->save();
        }

        if ($request->type == 2) {
            //use the method in the trait
            $path = $request->file('logo')->store('university_logo', 'public');
            Portfolio::create([
                'user_id' => $user->id,
                'university_name' => $request->university_name,
                'uni_email' => $request->uni_email,
                'uni_phone_number' => $request->uni_phone_number,
                'logo' => $path,
                'website_url' => $request->website_url,
            ]);
        }

        toastr()->success('University created successfully.', 'University Created');
        return redirect()->route('users.index');
    }

    // Display the specified user
    public function show(User $user)
    {
        return view('admin.university.show', compact('user'));
    }

    // Show the form for editing the specified user
    public function edit($id)
    {
        $user  = User::find($id);
        return view('admin.university.edit', compact('user'));
    }

    // Update the specified user in storage
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'national_id' => 'required|string|min:13|max:13|unique:users,national_id,' . $user->id,
            'date_of_birth' => 'required|date|before:today',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:20|unique:users,phone_number,' . $user->id,
            'type' => 'required|in:0,1,2',
            'password' => 'nullable|string|min:8',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // If validation fails, redirect back to the form with the validation errors and old input
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // Check if a new password was provided
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            // Remove password from the validated data array if not changing
            unset($validatedData['password']);
        }

        // Update email verification status if needed
        if ($request->has('is_email_verified') && $request->is_email_verified == '1') {
            $validatedData['email_verified_at'] = Carbon::now();
        } else {
            $validatedData['email_verified_at'] = null;
        }

        // Exclude is_email_verified from the $validatedData as it's not a direct column in the users table
        unset($validatedData['is_email_verified']);

        // Update the user with the validated and possibly modified data
        $user->update($validatedData);

        toastr()->success('University updated successfully.', 'University Updated');
        return redirect()->route('users.index');
    }

    // Remove the specified user from storage
    public function destroy(User $user)
    {

        if ($user->exists()) {

            if ($user->portfolio){
                $user->portfolio->delete();
            }

            $user->delete();
            toastr()->success('University Deletedd successfully.', 'University Deleted');
            return back()->with('success', 'University deleted successfully.');
        }

        toastr()->error('Ooh this user was not found.', 'Error');
        return back();
    }
}

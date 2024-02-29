<?php

namespace App\Http\Controllers\Common;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $user = User::findOrFail(Auth::user()->id);
        return view('common.edit', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('common.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'national_id' => 'required|string|min:13|max:13|unique:users,national_id,' . $user->id,
            'date_of_birth' => 'required|date|before:today',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:20|unique:users,phone_number,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // If validation fails, redirect back to the form with the validation errors and old input
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validator_portfolio = null;
        if ($request->type == 'university') {

            $validator_portfolio = Validator::make($request->all(), [
                'uni_email' => 'required|email|max:255',
                'uni_phone_number' => 'required|string|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'website_url' => 'required|url|max:255',
                'university_name' => 'required|string|max:255'
            ]);

            if ($validator_portfolio->fails()) {
                // If validation fails, redirect back to the form with the validation errors and old input
                return redirect()->back()->withErrors($validator_portfolio)->withInput();
            }
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

        $portfolio = Portfolio::where('user_id', $user->id)->first();

        $data_university = $validator_portfolio->validated();
        if ($request->type == 'university') {
            //use the method in the trait
            if ($request->file('logo') != null) {
                $data_university['logo'] = $request->file('logo')->store('university_logo', 'public');
            } else {

                $data_university['logo'] = $portfolio->logo;
            }
            $portfolio->update($data_university);
        }

        toastr()->success('University updated successfully.', 'University Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\SubjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Usernotnull\Toast\Concerns\WireToast;

class SubjectController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the logged-in user
        $subjects = $user->subjects; // Get the user's subjects

        return view("student.subjects.index", compact('subjects'));
    }

    public function create()
    {
        $subjects = Subject::all(); // Assuming you have a Subject model

        return view("student.subjects.create", compact("subjects"));
    }

    /**
     * Attach a subject with result and level to a user.
     *
     * @param  Request  $request
     */
    public function attachSubject(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'result' => 'required|string',
            'level' => 'required|string'
        ]);

        // Retrieve the user and subject from the database
        $userId = Auth::id();

        $user = User::findOrFail($userId);
        $subjectId = $validated['subject_id'];

        // Data to attach with the pivot table
        $pivotData = [
            'result' => $validated['result'] ?? null, // Use null as default if not provided
            'level' => $validated['level'] ?? null, // Use null as default if not provided
        ];

        $subjectExists = $user->subjects()->where('subject_id', $subjectId)->exists();
        if (!$subjectExists) {
            // Subject not already associated with the user, proceed to attach
            $user->subjects()->syncWithoutDetaching([$subjectId => $pivotData]);
            // Redirect with success message
            toastr()->success('Data has been saved successfully!', 'Congrats');
            return redirect()->route('subjects');
        } else if ($subjectExists) {

            toastr()->error('Oops! Subject already exist!', 'Oops!');
            return redirect()->back();

        } else {
            // Failed to attach subject
            toastr()->error('An error has occurred please try again later.');
            return redirect()->back();
        }


        // Attach the subject to the user with result and level
        // This method will add a new entry if it doesn't exist, or ignore if it already exists

        // Check if the subject was successfully attached
        if ($user->subjects()->where('subjects.id', $subjectId)->exists()) {
            // Success, subject was attached
            return redirect()->route('subjects')->with('toast_success', 'Subject attached successfully.');
        } else {
            // Failed to attach subject
            return redirect()->back()->with('toast_error', 'Failed to attach subject.');
        }


    }

    public function deleteSubject($subjectId)
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Check if the subject is already associated with the user
        $subjectExists = $user->subjects()->where('subject_id', $subjectId)->exists();

        if ($subjectExists) {
            // Detach the subject from the user
            $user->subjects()->detach($subjectId);
            // Redirect back with a success message
            
            toastr()->success('Subject removed successfully.', 'Congrats');
            return redirect()->back();
        }

        // If the subject was not found or not associated, redirect back with an error message
        toastr()->error('Subject not found or not associated with the user.');
        return redirect()->back();
    }

    public function edit($subjectId)
    {
        $subjects = Subject::all();
        $user = Auth::user(); // Get the currently authenticated user
        // Check if the subject is already associated with the user
        $subjectExists = $user->subjects()->where('subject_id', $subjectId)->first();


        return view('student.subjects.edit', compact('subjects', 'subjectExists', 'subjectId'));
    }

    public function update(Request $request)
    {

        $userId = Auth::id();

        $request->validate([
            'result' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'old_subject_id' => 'required|integer|exists:subjects,id',
            'new_subject_id' => 'required|integer|exists:subjects,id',
        ]);


        $user = User::findOrFail($userId);
        $oldSubjectId = $request->old_subject_id;
        $newSubjectId = $request->new_subject_id;

        Session::put('oldSubjectId', $oldSubjectId);
        Session::put('newSubjectId', $newSubjectId);

        // Check if the user is already associated with the old subject
        if ($user->subjects()->find($oldSubjectId)) {
            // Detach the old subject and attach the new subject
            $user->subjects()->detach($oldSubjectId);
            $user->subjects()->attach($newSubjectId, ['result' => $request->result, 'level' => $request->level,]); // Add any additional pivot fields if necessary

            toastr()->success('Subject updated successfully.', 'Congrats');
            return redirect('subjects');
        } else {

            toastr()->error('The selected subject was not found for the user.');
            return redirect()->back();
        }
    }
}

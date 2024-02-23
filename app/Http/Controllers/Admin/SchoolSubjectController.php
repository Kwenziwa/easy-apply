<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class SchoolSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subject.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subjects,name',
            'code' => 'required|int|unique:subjects,code',

        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // If validation fails, redirect back to the form with the validation errors and old input
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();
        Subject::create($validatedData);
        toastr()->success('Subject created successfully.', 'Subject Created');
        return redirect()->route('school-subjects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('admin.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $subject = Subject::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|int|unique:subjects,code',

        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // If validation fails, redirect back to the form with the validation errors and old input
            toastr()->error('Ooh-Ooh Something went wrong.', 'Error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();
        $subject->update($validatedData);
        toastr()->success('Subject created successfully.', 'Subject Created');
        return redirect()->route('school-subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);

        if ($subject->exists()) {
            $subject->users()->detach();
            $subject->delete();
            return back()->with('success', 'Subject deleted successfully...');
        }

        return back()->with('error', 'Ooh this subject was not found.');
    }
}

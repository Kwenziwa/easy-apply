<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Subject;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ProgrammeSubject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programmes = Programme::all();
        return view('admin.programme.index', compact('programmes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('type', 2)->with('portfolio')->get();
        $subjects = Subject::all();
        return view('admin.programme.create', compact(['users', 'subjects']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $filteredArray = [];
        // Filter out arrays that have null or empty 'subject_id' or 'level'
        if (!is_null($request->addMore)) {
            $filteredArray = array_filter($request->addMore, function ($item) {
                return !empty($item['subject_id']) && !empty($item['level']);
            });
        }

        $validator = Validator::make($request->all(), [
            'portfolio_id' => 'required|exists:portfolios,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:programmes,code',
            'closing_date' => 'required|date',
            'min_points' => 'required|numeric',
            'min_entry_requirements' => 'required|string|max:255',
            'entry_term' => 'required|string|max:255',
            'course_duration' => 'required|numeric',
            'access_route' => 'nullable|string|max:255',
            'application_url' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // If validation fails, redirect back to the form with the validation errors and old input
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();
        $programme = Programme::create($validatedData);

        // Check if the filtered array is empty
        if (!is_null($filteredArray)) {

            foreach ($request->addMore as $key => $value) {
                $value['programme_id'] = $programme->id;

                $programmeSubject = ProgrammeSubject::firstOrNew($value);
                if (!$programmeSubject->exists) {
                    $programmeSubject->save(); // Save only if it's a new model
                }
            }
        }
        toastr()->success('Programme created successfully.', 'Programme Created');
        return redirect()->route('programmes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::where('type', 2)->with('portfolio')->get();
        $programme = Programme::find($id);
        $subjects = Subject::all();
        $programme_subjects = ProgrammeSubject::where('programme_id', $id)->get();
        return view('admin.programme.show', compact(['programme', 'users', 'subjects', 'programme_subjects']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::where('type', 2)->with('portfolio')->get();
        $programme = Programme::find($id);
        $subjects = Subject::all();
        $programme_subject = ProgrammeSubject::where('programme_id', $id)->get();
        return view('admin.programme.edit', compact(['programme', 'users', 'subjects', 'programme_subject']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the Programme or fail
        $programme = Programme::findOrFail($id);

        // Filter out arrays that have null or empty 'subject_id' or 'level'

        $filteredArray = [];
        // Filter out arrays that have null or empty 'subject_id' or 'level'
        if (!is_null($request->addMore)) {
            $filteredArray = array_filter($request->addMore, function ($item) {
                return !empty($item['subject_id']) && !empty($item['level']);
            });
        }

        $validator = Validator::make($request->all(), [
            'portfolio_id' => 'required|exists:portfolios,id',
            'name' => 'required|string|max:255',
            // Ensure the code is unique but ignore for the current programme
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('programmes')->ignore($programme->id),
            ],
            'closing_date' => 'required|date',
            'min_points' => 'required|numeric',
            'min_entry_requirements' => 'required|string|max:255',
            'entry_term' => 'required|string|max:255',
            'course_duration' => 'required|numeric',
            'access_route' => 'nullable|string|max:255',
            'application_url' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // If validation fails, redirect back to the form with the validation errors and old input
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();
        $programme->update($validatedData);

        // Check if the filtered array is empty
        if (!is_null($request->addMore)) {
            ProgrammeSubject::where('programme_id', $programme->id)->delete();
            foreach ($request->addMore as $key => $value) {
                $value['programme_id'] = $programme->id;

                $programmeSubject = ProgrammeSubject::firstOrNew($value);
                if (!$programmeSubject->exists) {
                    $programmeSubject->save(); // Save only if it's a new model
                }
            }
        } else {
            ProgrammeSubject::where('programme_id', $programme->id)->delete();
        }

        toastr()->success('Programme updated successfully.', 'Programme Updated');
        return redirect()->route('programmes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $programme = Programme::findOrFail($id);

        if ($programme->exists()) {
            $programme->delete();
            return back()->with('success', 'Programme deleted successfully...');
        }

        return back()->with('error', 'Ooh this programme was not found.');
    }
}

<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Subject;
use App\Models\Programme;
use Illuminate\Http\Request;
use App\Models\ProgrammeSubject;
use App\Http\Controllers\Controller;

class StudentProgrammeController extends Controller
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
        //
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
        $users = User::where('type', 2)->with('portfolio')->get();
        $programme = Programme::find($id);
        $subjects = Subject::all();
        $programme_subjects = ProgrammeSubject::where('programme_id', $id)->get();
        return view('student.programme.show', compact(['programme', 'users', 'subjects', 'programme_subjects']));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

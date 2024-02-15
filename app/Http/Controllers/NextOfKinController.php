<?php

namespace App\Http\Controllers;

use App\Models\NextOfKin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NextOfKinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nextOfkin = NextOfKin::where('user_id', Auth::user()->id)->first();
        return view('student.kin.index', compact('nextOfkin'));
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
        $nextOfkin = NextOfKin::where('user_id', Auth::user()->id)->first();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'relationship' => 'required|string|max:255',
            'address' => 'required',
            'phone_number' => 'required|string',
        ]);
        $request->merge(['user_id' => Auth::user()->id]);

        if($nextOfkin->exists()){
            NextOfKin::find($nextOfkin->id)->update($request->all());
            toastr()->success('Next Of Kin updated successfully.', 'Congrats');

        }else{
            NextOfKin::create($request->all());
            toastr()->success('Next Of Kin added successfully.', 'Congrats');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(NextOfKin $nextOfKin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NextOfKin $nextOfKin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NextOfKin $nextOfKin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NextOfKin $nextOfKin)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Docs;
use App\Traits\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocsKinController extends Controller
{
    use FileUploader; //add this trait
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $documents = Docs::all();
        return view("student.doc.index", compact('documents'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mydocs = Docs::where('user_id', Auth::user()->id);

        if ($mydocs->count() >= 2) {
            toastr()->error('Oops! You have reach limit of file upload!', 'Oops!');
            return redirect()->back();
        }

        return view("student.doc.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'path' => 'required|file|mimes:pdf,jpeg,png|max:1048', // Example for common document/image types
            'doc_type' => 'required|string', // Example with predefined types
        ], [
            'path.required' => "Document  is required",
            'path.max' => "Maximum file size to upload is 1MB (1048 KB). If you are uploading a file, try to reduce its resolution to make it under 1MB",
            'doc_type.required' => 'Document type is required'
        ]);



        if ($request->hasFile('path')) {
            $path = $this->UploadFile($request->file('path'), $request->doc_type); //use the method in the trait
            Docs::create([
                'user_id' => Auth::user()->id,
                'path' => $path,
                'doc_type' => $request->doc_type
            ]);

            toastr()->success('Your file has been uploaded successfully', 'Success!');
            return redirect()->route('my-documents.index');
        }

        toastr()->error('Oops! something went wrong', 'Ooh Ooh!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Docs $docs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Docs $docs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Docs $docs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($doc_id)
    {
        $docs = Docs::find($doc_id);
        if ($docs->delete()) {
            toastr()->success('Your file has been deleted successfully', 'Success!');
        } else {
            toastr()->error('Oops! file not found', 'Ooh Ooh!');
        }

        return redirect()->route('my-documents.index');
    }
}

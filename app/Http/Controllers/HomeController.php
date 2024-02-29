<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Subject;
use App\Models\Programme;
use Illuminate\View\View;
use App\Models\SubjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();

        $userWithLevelSum = User::select('users.id', 'users.first_name', 'users.last_name')
            ->selectRaw('SUM(subject_user.level) as level_sum')
            ->join('subject_user', 'users.id', '=', 'subject_user.user_id')
            ->join('subjects', 'subjects.id', '=', 'subject_user.subject_id')
            ->where('users.id', $userId)
            ->groupBy('users.id', 'users.first_name', 'users.last_name')
            ->first();

        $userWithSubjectsCount = User::withCount('subjects')->find($userId);

        // get user subject and results
        $userSubjects = SubjectUser::where('user_id', $userId)->get(['subject_id', 'level']);
        // get programmes, subject and results
        $avail_programmes = Programme::with('subjects')->paginate(1);
        $qualify_programmes = Programme::where('min_points', '>=', $userWithSubjectsCount)->whereDate('closing_date', '>', Carbon::now())->get();



        // Iterate over each programme
        // foreach ($avail_programmes as $programme) {
        //     echo "Programme Name: " . $programme->name . "\n <br/>"; // Example property access

        //     // Check if there are any subjects associated with the programme
        //     if ($programme->subjects->isNotEmpty()) {
        //         echo "Subjects:\n";
        //         // Iterate over each subject associated with the programme
        //         foreach ($programme->subjects as $subject) {
        //             echo "- " . $subject->name . "\n <br/>";
        //             echo "- " . $subject->id . "\n <br/>"; // Example property access
        //             echo "- " . $programme->id . "\n <br/>";
        //         }
        //     } else {
        //         echo "No subjects found for this programme.\n";
        //     }
        // }
        //return \Response::json($avail_programme, 200);
        return view('student.home', compact('userWithLevelSum', 'userWithSubjectsCount', 'qualify_programmes'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {

        return view('admin.home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function universityHome(): View
    {

        $userId = Auth::id();

        $userWithLevelSum = User::select('users.id', 'users.first_name', 'users.last_name')
            ->selectRaw('SUM(subject_user.level) as level_sum')
            ->join('subject_user', 'users.id', '=', 'subject_user.user_id')
            ->join('subjects', 'subjects.id', '=', 'subject_user.subject_id')
            ->where('users.id', $userId)
            ->groupBy('users.id', 'users.first_name', 'users.last_name')
            ->first();

        $userWithSubjectsCount = User::withCount('subjects')->find($userId);

        // get user subject and results
        $userSubjects = SubjectUser::where('user_id', $userId)->get(['subject_id', 'level']);
        // get programmes, subject and results
        $avail_programmes = Programme::with('subjects')->paginate(1);
        $qualify_programmes = Programme::where('min_points', '>=', $userWithSubjectsCount)->whereDate('closing_date', '>', Carbon::now())->get();


        return view('university.home', compact('userWithLevelSum', 'userWithSubjectsCount', 'qualify_programmes'));
    }

    public function dashboard($type)
    {
        if ($type == 'user') {
            return redirect()->route('student.home');
        } elseif ($type == 'admin') {
            return redirect()->route('admin.home');
        } elseif ($type == 'university') {
            return redirect()->route('university.home');
        } else {
            return '/';
        }
    }

    public function getSubjects()
    {
        $subjects = Subject::all(); // Assuming you have a Subject model
        return response()->json($subjects);
    }

    public function toggleTheme(Request $request)
    {
        $theme = session('theme', 'light');
        $newTheme = $theme === 'light' ? 'dark' : 'light';
        session(['theme' => $newTheme]);

        return back();
    }


}


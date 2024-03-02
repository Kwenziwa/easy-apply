<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Subject;
use App\Models\Portfolio;
use App\Models\Programme;
use Illuminate\View\View;
use App\Models\SubjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $usersPerMonth = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();

        $months = [];
        $counts = [];

        foreach ($usersPerMonth as $data) {
            $months[] = date('F', mktime(0, 0, 0, $data->month, 1)); // Convert month number to month name
            $counts[] = $data->count;
        }

        $userTypes = User::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get();

        $types = $userTypes->pluck('type');
        $type_counts = $userTypes->pluck('count');

        // Get
        $now = Carbon::now();
        $beforeNow = Programme::where('closing_date', '<', $now)->count();
        $afterNow = Programme::where('closing_date', '>=', $now)->count();

        //data
        $count_data = [
            'students_counter' => User::where('type', 0)->count(),
            'university_counter' => User::where('type', 2)->count(),
            'program_count' => Programme::count(),
            'subject_count' => Subject::count(),
        ];
        return view('admin.home', compact('months', 'counts', 'types', 'type_counts', 'beforeNow', 'afterNow', 'count_data'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function universityHome(): View
    {


        $user = Auth::user();
        $userWithLevelSum = User::select('users.id', 'users.first_name', 'users.last_name')
            ->selectRaw('SUM(subject_user.level) as level_sum')
            ->join('subject_user', 'users.id', '=', 'subject_user.user_id')
            ->join('subjects', 'subjects.id', '=', 'subject_user.subject_id')
            ->where('users.id', $user->id)
            ->groupBy('users.id', 'users.first_name', 'users.last_name')
            ->first();

        $userWithSubjectsCount = User::withCount('subjects')->find($user->id);
        $avail_programmes = Programme::where('portfolio_id', $user->portfolio->id);
        $total_programme = $avail_programmes->count();

        $open_programmes = $avail_programmes->whereDate('closing_date', '>', Carbon::now())->count();
        $closed_programmes = $avail_programmes->whereDate('closing_date', '<', Carbon::now())->count();

        $recent_programmes = Programme::where('portfolio_id', $user->portfolio->id)->orderBy('created_at', 'desc')->take(1)->get();


        return view('university.home', compact('total_programme', 'open_programmes', 'closed_programmes', 'recent_programmes'));
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


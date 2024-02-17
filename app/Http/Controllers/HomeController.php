<?php

namespace App\Http\Controllers;

use App\Models\SubjectUser;
use App\Models\User;
use Illuminate\View\View;
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

        $userWithLevelSum = User::select('users.id', 'users.first_name', 'users.last_name') // Specify needed columns
            ->selectRaw('SUM(subject_user.level) as level_sum')
            ->join('subject_user', 'users.id', '=', 'subject_user.user_id')
            ->join('subjects', 'subjects.id', '=', 'subject_user.subject_id')
            ->where('users.id', $userId)
            ->groupBy('users.id', 'users.first_name', 'users.last_name') // Group by these columns
            ->first();

        $userWithSubjectsCount = User::withCount('subjects')->find($userId);

        return view('student.home', compact('userWithLevelSum', 'userWithSubjectsCount'));
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
        return view('university.home');
    }
}

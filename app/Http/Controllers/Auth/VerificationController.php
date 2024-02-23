<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Where to redirect users after verification.
     *
     * @return string
     */
    protected function redirectTo()
    {
        // Example redirection logic based on user role
        if (auth()->user()->type == 0) {
            return redirect()->route('student.home');
        } elseif (auth()->user()->type == 1) {
            return redirect()->route('admin.home');
        } elseif (auth()->user()->type == 2) {
            return redirect()->route('university.home');
        } else {
            return '/';
        }
    }





    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}

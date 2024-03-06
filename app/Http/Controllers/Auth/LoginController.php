<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Ini akan digantikan oleh metode redirectTo()

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override the method to send the response after the user was authenticated.
     * Redirect users based on their role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('superadmin')) {
            return redirect('/dashboard/superadmin');
        } elseif ($user->hasRole('admin_sekolah')) {
            return redirect('/dashboard/schooladmin');
        } elseif ($user->hasRole('guru')) {
            return redirect('/dashboard/teacher');
        } elseif ($user->hasRole('siswa')) {
            return redirect('/dashboard/student');
        }

        return redirect('/home'); // Fallback redirect
    }
}

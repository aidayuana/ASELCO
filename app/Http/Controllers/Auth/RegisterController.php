<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'school_id' => ['required', 'exists:schools,id'],
            'class_id' => ['required', 'exists:classes,id'],
        ]);
    }

    protected function create(array $data)
    {
        Log::info('Creating user', $data); // Log data pengguna yang akan dibuat

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'school_id' => $data['school_id'],
            'class_id' => $data['class_id'],
        ]);

        $user->assignRole('student');

        Log::info('User created successfully', ['user_id' => $user->id]); // Log setelah pengguna berhasil dibuat

        return $user;
    }

    public function showRegistrationForm()
    {
        $schools = School::all(); // Get all schools
        return view('auth.register', compact('schools'));
    }
    // Override method redirectTo untuk mengarahkan pengguna ke halaman login setelah berhasil registrasi
    protected function redirectTo()
    {
        return route('login');
    }

    
}

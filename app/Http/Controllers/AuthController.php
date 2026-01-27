<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Please provide a valid email',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // Check if user exists, password is correct, and status is active
        if (!$user || !Hash::check($request->password, $user->password) || $user->status !== 'active') {
            return back()->withErrors([
                'email' => 'Invalid credentials or account is not active.',
            ])->onlyInput('email');
        }

        // Login the user
        Auth::login($user, $request->remember);

        // Redirect based on role
        return redirect()->route('dashboard');
    }

    /**
     * Show dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();

        return view('dashboard', [
            'user' => $user,
        ]);
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}


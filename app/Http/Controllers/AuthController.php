<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login-daisyui');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // จำลองการ login โดยไม่ใช้ database
        // ในโปรเจกต์จริงจะใช้ Auth::attempt($credentials)
        if ($credentials['email'] === 'admin@example.com' && $credentials['password'] === 'password') {
            // จำลองการ login สำเร็จ
            session(['admin_logged_in' => true]);
            session(['admin_user' => [
                'name' => 'Admin User',
                'email' => 'admin@example.com'
            ]]);
            
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'ข้อมูลการเข้าสู่ระบบไม่ถูกต้อง',
        ])->onlyInput('email');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        session()->forget(['admin_logged_in', 'admin_user']);
        
        return redirect()->route('login');
    }
}
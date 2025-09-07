<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!session('admin_logged_in')) {
                return redirect()->route('login');
            }
            return $next($request);
        });
    }

    /**
     * Show the dashboard
     */
    public function index()
    {
        return view('dashboard-daisyui');
    }
}
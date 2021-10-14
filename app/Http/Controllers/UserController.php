<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * The attributes that are mass assignable.
     *
     * @return View
     */
    public function index(): View
    {
        return view('users');
    }

    public function logout(): Redirector|Application|RedirectResponse
    {
        $username = Auth::user();
        Log::info(__CLASS__ . __FUNCTION__ . __LINE__, ['Message' => 'User ' . $username . ' logout.']);
        Auth::logout();
        return redirect('/login');
    }
}

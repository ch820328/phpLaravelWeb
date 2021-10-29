<?php

namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class UsersController extends Controller
{
    private UsersService $usersService;

    public function __construct(
        UsersService $userService,
    ) {
        $this->usersService     = $userService;
    }
    /**
     * @return View
     */
    public function index(): View
    {
        return view('users');
    }

    /**
     * @return Redirector|Application|RedirectResponse
     */
    public function logout(): Redirector|Application|RedirectResponse
    {
        $username = Auth::user();
        Log::info(__CLASS__ . __FUNCTION__ . __LINE__, ['Message' => 'User ' . $username . ' logout.']);
        Auth::logout();
        return redirect('/login');
    }

    /**
     * @return Collection|null
     */
    public function getUserList(): ?Collection
    {
        dd($this->usersService->getAllUsers());
        return $this->usersService->getAllUsers();
    }
}

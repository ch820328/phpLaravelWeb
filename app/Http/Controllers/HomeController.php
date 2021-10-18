<?php

namespace App\Http\Controllers;

use App\Services\CalendarEventService;
use App\Services\UsersService;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Log;
use Throwable;

class HomeController extends Controller
{
    private CalendarEventService $calendarEventService;
    private UsersService         $usersService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->calendarEventService = new CalendarEventService();
        $this->usersService         = new UsersService();
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home');
    }

    /**
     * @return string
     */
    public function getCalendarEvent(): string
    {
        return json_encode($this->calendarEventService->getCalendarEventArray());
    }

    /**
     * @return string
     */
    public function getUserList(): string
    {
        return json_encode($this->usersService->getUserList());
    }


    /**
     * @return string
     */
    public function getFutureEventList(): string
    {
        return json_encode($this->calendarEventService->getFutureEventListArray());
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function addCalendarEvent(Request $request): bool
    {
        $userId   = Auth::user()->{'id'};
        $userName = Auth::user()->{'name'};
        return $this->calendarEventService->createCalendarEvent($request, $userId, $userName);
    }

    /**
     * @param int $eventId
     *
     * @return bool
     * @throws Throwable
     */
    public function deleteCalendarEvent(int $eventId): bool
    {
        DB::beginTransaction();
        try {
            $result = $this->calendarEventService->deleteCalendarEvent($eventId);
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            DB::rollBack();
            throw $e;
        }

        return $result;
    }
}

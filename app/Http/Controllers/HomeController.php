<?php

namespace App\Http\Controllers;

use App\Services\CalendarEventService;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use DB;
use Log;
use Exception;
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
     * Show the application dashboard.
     *
     * @return JsonResponse
     */
    public function checkWebAuth(): JsonResponse
    {
        return response()->json(['result' => true], 200);
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
     * @return JsonResponse
     */
    public function addCalendarEvent(Request $request): JsonResponse
    {
        Log::info(__CLASS__ . ' - ' .  __FUNCTION__ . ' - ' . __LINE__);
        Log::info($request);
        $result = $this->calendarEventService->createCalendarEvent($request);

        if ($result) {
            $statusCode = 201;
        } else {
            $statusCode = 400;
        }
        return response()->json(['result' => $result], $statusCode);
    }

    /**
     * @param int $eventId
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function deleteCalendarEvent(int $eventId): JsonResponse
    {
        DB::beginTransaction();
        try {
            $result = $this->calendarEventService->deleteCalendarEvent($eventId);
            DB::commit();
        } catch (Exception $e) {
            Log::info(__CLASS__ . ' - ' .  __FUNCTION__ . ' - ' . __LINE__);
            Log::error($e->getMessage());
            DB::rollBack();
            throw $e;
        }

        if ($result) {
            $statusCode = 204;
        } else {
            $statusCode = 400;
        }
        return response()->json(['result' => $result], $statusCode);
    }
}

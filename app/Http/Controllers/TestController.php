<?php

namespace App\Http\Controllers;

use App\Repositories\CalendarEventRepo;
use Carbon\Carbon;
use App\Services\CalendarEventService;
use phpDocumentor\Reflection\Types\Collection;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return string
     */
    public function Test(): string
    {
        $data = [
            'data' => 'TestA',
        ];

        return json_encode($data);
    }

    /**
     * @return string
     */
    public function Test2(): string
    {
        $test = new CalendarEventService();
        $test2 = $test->getCalendarEventArray();
        return json_encode($test2);
    }
}

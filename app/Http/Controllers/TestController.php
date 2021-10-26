<?php

namespace App\Http\Controllers;

use App\Services\CalendarEventService;
use InformationRepo;
use JetBrains\PhpStorm\NoReturn;

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

    #[NoReturn] public function Test2()
    {
        dd(InformationRepo::findByPage('Family'));
        return InformationRepo::findByPage($page);
    }
}

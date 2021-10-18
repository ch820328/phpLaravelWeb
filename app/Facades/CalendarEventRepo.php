<?php

namespace App\Facades;

use App\Contracts\Repositories\CalendarEventRepoContract;
use Illuminate\Support\Facades\Facade;

class CalendarEventRepo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CalendarEventRepoContract::class;
    }
}

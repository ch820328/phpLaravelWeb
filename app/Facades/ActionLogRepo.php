<?php

namespace App\Facades;

use App\Contracts\Repositories\ActionLogRepoContract;
use Illuminate\Support\Facades\Facade;

class ActionLogRepo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActionLogRepoContract::class;
    }
}

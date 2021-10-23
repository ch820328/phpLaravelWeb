<?php

namespace App\Facades;

use App\Contracts\Repositories\UsersRepoContract;
use Illuminate\Support\Facades\Facade;

class UsersRepo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return UsersRepoContract::class;
    }
}

<?php

namespace App\Facades;

use App\Contracts\Repositories\RoleRepoContract;
use Illuminate\Support\Facades\Facade;

class RoleRepo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return RoleRepoContract::class;
    }
}

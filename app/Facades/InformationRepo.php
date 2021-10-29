<?php

namespace App\Facades;

use App\Contracts\Repositories\InformationRepoContract;
use Illuminate\Support\Facades\Facade;

class InformationRepo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return InformationRepoContract::class;
    }
}

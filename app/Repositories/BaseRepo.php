<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepoContract;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class BaseRepo extends BaseRepository implements BaseRepoContract
{
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
    }
}

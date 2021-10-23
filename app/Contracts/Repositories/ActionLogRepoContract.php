<?php

namespace App\Contracts\Repositories;

use App\Contracts\Entities\ActionLog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\ParameterBag;

interface ActionLogRepoContract extends BaseRepoContract
{
    /**
     * @return ActionLog
     */
    public function make(): ActionLog;

    /**
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function findByPage(int $limit): LengthAwarePaginator;

    /**
     * @param ParameterBag $bag
     * @param int          $limit
     * @return LengthAwarePaginator
     */
    public function findBySearch(ParameterBag $bag, int $limit): LengthAwarePaginator;
}

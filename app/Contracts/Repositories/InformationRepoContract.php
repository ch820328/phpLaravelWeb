<?php

namespace App\Contracts\Repositories;

use App\Contracts\Entities\Information;
use Illuminate\Database\Eloquent\Collection;

interface InformationRepoContract extends BaseRepoContract
{
    /**
     * @return Information
     */
    public function make(): Information;

    /**
     * @param $id
     *
     * @return Information|null
     */
    public function findById($id): ?Information;

    /**
     * @param string $userName
     *
     * @return Information|null
     */
    public function findByUserName(string $userName): ?Information;

    /**
     * @param string $page
     *
     * @return Collection|Information[]|null
     */
    public function findByPage(string $page): Collection;
}

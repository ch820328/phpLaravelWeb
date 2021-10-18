<?php

namespace App\Repositories;

use App\Contracts\Repositories\RoleRepoContract;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as RoleModel;

class RoleRepo extends BaseRepo implements RoleRepoContract
{
    public function make(): Role
    {
        return new RoleModel();
    }

    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return RoleModel::class;
    }
}

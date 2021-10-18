<?php

namespace App\Contracts\Repositories;

use Spatie\Permission\Contracts\Role;

interface RoleRepoContract extends BaseRepoContract
{
    /**
     * @return Role
     */
    public function make(): Role;
}

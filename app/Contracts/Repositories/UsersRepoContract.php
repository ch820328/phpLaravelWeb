<?php

namespace App\Contracts\Repositories;

use App\Contracts\Entities\Users;

interface UsersRepoContract extends BaseRepoContract
{
    /**
     * @return Users
     */
    public function make(): Users;

    /**
     * @param $id
     *
     * @return Users|null
     */
    public function findById($id): ?Users;

    /**
     * @param string $email
     *
     * @return Users|null
     */
    public function findByEmail(string $email): ?Users;

    /**
     * @param string $userName
     *
     * @return Users|null
     */
    public function findByUserName(string $userName): ?Users;
}

<?php

namespace App\Repositories;

use App\Contracts\Entities\Users;
use App\Contracts\Repositories\UsersRepoContract;
use App\Models\Eloquent\UsersEloquent;

class UsersRepo extends BaseRepo implements UsersRepoContract
{
    public function make(): Users
    {
        return new UsersEloquent();
    }

    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return UsersEloquent::class;
    }

    /**
     * @inheritDoc
     */
    public function findById($id): ?Users
    {
        return UsersEloquent::where('id', $id)->first();
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): ?Users
    {
        return $this->findByField('email', $email)->first();
    }

    /**
     * @inheritDoc
     */
    public function findByUserName(string $userName): ?Users
    {
        return UsersEloquent::where('name', $userName)->first();
    }

}

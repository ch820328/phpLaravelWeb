<?php

namespace App\Repositories;

use App\Contracts\Entities\Information;
use App\Contracts\Repositories\InformationRepoContract;
use App\Models\Eloquent\InformationEloquent;
use Illuminate\Database\Eloquent\Collection;

class InformationRepo extends BaseRepo implements InformationRepoContract
{
    public function make(): Information
    {
        return new InformationEloquent();
    }

    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return InformationEloquent::class;
    }

    /**
     * @inheritDoc
     */
    public function findById($id): ?Information
    {
        return InformationEloquent::where('id', $id)->first();
    }

    /**
     * @inheritDoc
     */
    public function findByUserName(string $userName): ?Information
    {
        return InformationEloquent::where('user_name', $userName)->first();
    }

    /**
     * @inheritDoc
     */
    public function findByPage(string $page): Collection
    {
        return InformationEloquent::where('page', $page)->orderBy('type', 'desc')->get();
    }
}

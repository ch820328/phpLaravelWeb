<?php

namespace App\Repositories;

use App\Contracts\Entities\ActionLog;
use App\Contracts\Repositories\ActionLogRepoContract;
use App\Models\Eloquent\ActionLogEloquent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\ParameterBag;

class ActionLogRepo extends BaseRepo implements ActionLogRepoContract
{
    public function make(): ActionLog
    {
        return new ActionLogEloquent();
    }

    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return ActionLogEloquent::class;
    }

    /**
     * @inheritDoc
     */
    public function findByPage(int $limit): LengthAwarePaginator
    {
        return ActionLogEloquent::orderBy('created_at', 'desc')->paginate($limit);
    }

    /**
     * @inheritDoc
     */
    public function findBySearch(ParameterBag $bag, int $limit): LengthAwarePaginator
    {
        $model = ActionLogEloquent::query();

        if ($bag->get('user_id')) {
            $model->where('user_id', $bag->get('user_id'));
        }

        if ($bag->get('user_name')) {
            $model->where('user_name', $bag->get('user_name'));
        }

        if ($bag->get('action')) {
            $model->where('action', $bag->get('action'));
        }

        if ($bag->get('event')) {
            $model->where('event', 'like', '%' . $bag->get('event') . '%');
        }

        if ($bag->get('ip')) {
            $model->where('ip', $bag->get('ip'));
        }

        if ($bag->get('dstart')) {
            $model->where('created_at', '>=', $bag->get('dstart'));
        }

        if ($bag->get('dend')) {
            $model->where('created_at', '<=', $bag->get('dend') . '23:59:59');
        }

        return $model->orderBy('created_at', 'desc')->paginate($limit);
    }
}

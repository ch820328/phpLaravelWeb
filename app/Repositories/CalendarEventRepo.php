<?php

namespace App\Repositories;

use App\Contracts\Entities\CalendarEvent;
use App\Contracts\Repositories\CalendarEventRepoContract;
use App\Models\Eloquent\CalendarEventEloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CalendarEventRepo extends BaseRepo implements CalendarEventRepoContract
{
    public function make(): CalendarEvent
    {
        return new CalendarEventEloquent();
    }

    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return CalendarEventEloquent::class;
    }

    /**
     * @inheritDoc
     */
    public function findById($id): ?CalendarEvent
    {
        return CalendarEventEloquent::where('id', $id)->first();
    }

    /**
     * @inheritDoc
     */
    public function findByUserName(string $userName): ?CalendarEvent
    {
        return CalendarEventEloquent::where('user_name', $userName)->first();
    }

    /**
     * @inheritDoc
     */
    public function findAllAlive(): Collection
    {
        return CalendarEventEloquent::query()->orderBy('id', 'desc')->get();
    }

    /**
     * @inheritDoc
     */
    public function findFutureEvent(): Collection
    {
        return CalendarEventEloquent::query()->where('end_at', '>', Carbon::today())->orderBy('user_name', 'desc')->get();
    }
}

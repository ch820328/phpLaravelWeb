<?php

namespace App\Contracts\Repositories;

use App\Contracts\Entities\CalendarEvent;
use Illuminate\Database\Eloquent\Collection;

interface CalendarEventRepoContract extends BaseRepoContract
{
    /**
     * @return CalendarEvent
     */
    public function make(): CalendarEvent;

    /**
     * @param $id
     *
     * @return CalendarEvent|null
     */
    public function findById($id): ?CalendarEvent;

    /**
     * @param string $userName
     *
     * @return CalendarEvent|null
     */
    public function findByUserName(string $userName): ?CalendarEvent;

    /**
     * @return Collection|CalendarEvent[]|null
     */
    public function findAllAlive(): Collection;

    /**
     * @return Collection|CalendarEvent[]|null
     */
    public function findFutureEvent(): Collection;
}

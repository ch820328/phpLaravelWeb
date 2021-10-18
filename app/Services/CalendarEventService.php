<?php

namespace App\Services;

use App\Contracts\Entities\CalendarEvent;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\ArrayShape;
use Log;
use Spatie\Permission\Contracts\Role;
use Illuminate\Http\Request;
use CalendarEventRepo;
use RoleRepo;

class CalendarEventService
{
    /**
     * @param string $username
     *
     * @return CalendarEvent|null
     */
    public function findByUsername(string $username): ?CalendarEvent
    {
        return CalendarEventRepo::findByUserName($username);
    }

    /**
     * @param int $id
     *
     * @return CalendarEvent
     */
    public function findById(int $id): CalendarEvent
    {
        return CalendarEventRepo::findById($id);
    }

    /**
     * @return array
     */
    public function getCalendarEventArray(): array
    {
        $usersService     = new UsersService();
        $event_collection = CalendarEventRepo::findAllAlive();
        $event_array      = [];
        $key              = 0;
        foreach ($event_collection as $calendarEvent) {
            $diff_day = Carbon::parse($calendarEvent->getEndAt())->diffInDays($calendarEvent->getStartAt(), true);
            $dotColor = $usersService->getUserMappingColor($calendarEvent->getUserName());
            for ($i = 0; $i <= $diff_day; $i++) {
                $event         = [
                    "key"     => $key,
                    "popover" => json_encode([
                                                 'label' => $calendarEvent->getEvent()
                                             ]),
                    "dot"     => $dotColor,
                    "dates"   => date_format(Carbon::parse($calendarEvent->getStartAt())->addDays($i), 'Y-m-d'),
                ];
                $event_array[] = $event;
                $key           += 1;
            }
        }
        return $event_array;
    }

    /**
     * @return array
     */
    public function getFutureEventListArray(): array
    {
        $event_collection = CalendarEventRepo::findFutureEvent();
        $event_array      = [];
        foreach ($event_collection as $calendarEvent) {
            $event         = [
                "id"       => $calendarEvent->getId(),
                "name"     => $calendarEvent->getUserName(),
                "start_at" => date_format(Carbon::parse($calendarEvent->getStartAt()), 'm-d'),
                "end_at"   => date_format(Carbon::parse($calendarEvent->getEndAt()), 'm-d'),
                "event"    => $calendarEvent->getEvent(),
            ];
            $event_array[] = $event;
        }
        return $event_array;
    }

    /**
     * @param Request $request
     * @param int     $userId
     * @param string  $userName
     *
     * @return bool
     */
    public function createCalendarEvent(Request $request, int $userId, string $userName): bool
    {
        try {
            $group = CalendarEventRepo::make();
            $group->setUserId($userId);
            $group->setUserName($userName);
            $group->setStartAt(Carbon::parse($request->get('start_date')));
            $group->setEndAt(Carbon::parse($request->get('end_date')));
            $group->setEvent($request->get('event'));

            CalendarEventRepo::create($group->toArray());

            return true;

        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            return false;
        }
    }

    /**
     * @param int $eventId
     *
     * @return bool
     */
    public function deleteCalendarEvent(int $eventId): bool
    {
        try {
            CalendarEventRepo::delete($eventId);
            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            return false;
        }
    }

    /**
     * @return Collection|Role
     */
    public function getRoles(): Collection|Role
    {
        return RoleRepo::all();
    }
}

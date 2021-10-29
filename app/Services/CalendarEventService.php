<?php

namespace App\Services;

use App\Contracts\Entities\CalendarEvent;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\Pure;
use Log;
use Spatie\Permission\Contracts\Role;
use Illuminate\Http\Request;
use CalendarEventRepo;
use RoleRepo;

class CalendarEventService
{
    private UsersService         $usersService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    #[Pure] public function __construct()
    {
        $this->usersService         = new UsersService();
    }

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
        $eventCollection = CalendarEventRepo::findAllAlive();
        $eventArray      = [];
        $key              = 0;
        foreach ($eventCollection as $calendarEvent) {
            $diffDay = Carbon::parse($calendarEvent->getEndAt())->diffInDays($calendarEvent->getStartAt(), true);
            $dotColor = $this->usersService->getUserColor($calendarEvent->getUserName());
            for ($i = 0; $i <= $diffDay; $i++) {
                $event         = [
                    "key"     => $key,
                    "popover" => json_encode([
                                                 'label' => $calendarEvent->getEvent()
                                             ]),
                    "dot"     => $dotColor,
                    "dates"   => date_format(Carbon::parse($calendarEvent->getStartAt())->addDays($i), 'Y-m-d'),
                ];
                $eventArray[] = $event;
                $key           += 1;
            }
        }
        return $eventArray;
    }

    /**
     * @return array
     */
    public function getFutureEventListArray(): array
    {
        $eventCollection = CalendarEventRepo::findFutureEvent();
        $eventArray      = [];
        foreach ($eventCollection as $calendarEvent) {
            $event         = [
                "id"       => $calendarEvent->getId(),
                "name"     => $calendarEvent->getUserName(),
                "start_at" => date_format(Carbon::parse($calendarEvent->getStartAt()), 'Y-m-d'),
                "end_at"   => date_format(Carbon::parse($calendarEvent->getEndAt()), 'Y-m-d'),
                "event"    => $calendarEvent->getEvent(),
            ];
            $eventArray[] = $event;
        }
        return $eventArray;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function createCalendarEvent(Request $request): bool
    {
        try {
            $group = CalendarEventRepo::make();
            $group->setUserId($this->usersService->findByUsername($request->get('name'))->getId());
            $group->setUserName($request->get('name'));
            $group->setStartAt(Carbon::parse($request->get('start_date')));
            $group->setEndAt(Carbon::parse($request->get('end_date')));
            $group->setEvent($request->get('event'));
            CalendarEventRepo::create($group->toArray());
            return true;
        } catch (Exception $e) {
            Log::info(__CLASS__ . ' - ' .  __FUNCTION__ . ' - ' . __LINE__);
            Log::error($e->getMessage());
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
            Log::info(__CLASS__ . ' - ' .  __FUNCTION__ . ' - ' . __LINE__);
            Log::error($e->getMessage());
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

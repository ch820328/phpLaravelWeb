<?php

namespace App\Contracts\Entities;

use Carbon\Carbon;

interface CalendarEvent extends BaseEntity
{

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return int
     */
    public function getUserId(): int;

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void;

    /**
     * @return string
     */
    public function getUserName(): string;

    /**
     * @param string $user_name
     */
    public function setUserName(string $user_name): void;

    /**
     * @return string
     */
    public function getEvent(): string;

    /**
     * @param string $event
     */
    public function setEvent(string $event): void;
    /**
     * @return Carbon
     */
    public function getStartAt(): Carbon;

    /**
     * @param Carbon $start_at
     */
    public function setStartAt(Carbon $start_at): void;

    /**
     * @return Carbon
     */
    public function getEndAt(): Carbon;

    /**
     * @param Carbon $end_at
     */
    public function setEndAt(Carbon $end_at): void;

    /**
     * @return Carbon
     */
    public function getDeletedAt(): Carbon;
}

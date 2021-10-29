<?php

namespace App\Models\Eloquent;

use App\Contracts\Entities\CalendarEvent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Eloquent;

/**
 * @property int    $id
 * @property int    $user_id
 * @property string $user_name
 * @property string $event
 * @property mixed  $start_at
 * @property mixed  $end_at
 * @property mixed  $created_at
 * @property mixed  $updated_at
 * @property mixed  $deleted_at
 */
class CalendarEventEloquent extends Eloquent implements CalendarEvent
{
    use SoftDeletes;

    protected $table = 'calendar_event';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'user_name', 'event', 'start_at', 'end_at', 'created_at', 'updated_at', 'deleted_at',
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->user_name;
    }

    /**
     * @param string $user_name
     */
    public function setUserName(string $user_name): void
    {
        $this->user_name = $user_name;
    }

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }

    /**
     * @param string $event
     */
    public function setEvent(string $event): void
    {
        $this->event = $event;
    }

    /**
     * @return Carbon
     */
    public function getStartAt(): Carbon
    {
        return Carbon::parse($this->start_at);
    }

    /**
     * @param Carbon $start_at
     */
    public function setStartAt(Carbon $start_at): void
    {
        $this->start_at = $start_at;
    }

    /**
     * @return Carbon
     */
    public function getEndAt(): Carbon
    {
        return Carbon::parse($this->end_at);
    }

    /**
     * @param Carbon $end_at
     */
    public function setEndAt(Carbon $end_at): void
    {
        $this->end_at = $end_at;
    }

    /**
     * @return Carbon
     */
    public function getDeletedAt(): Carbon
    {
        return Carbon::parse($this->deleted_at);
    }
}

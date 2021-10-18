<?php

namespace App\Models\Eloquent;

use App\Contracts\Entities\ActionLog;
use Carbon\Carbon;
use Eloquent;

/**
 * @property int         $id
 * @property int         $user_id
 * @property string      $user_name
 * @property string      $permission
 * @property string      $action
 * @property string      $event
 * @property string|null $note
 * @property string      $ip
 * @property mixed       $created_at
 * @property mixed       $updated_at
 */
class ActionLogEloquent extends Eloquent implements ActionLog
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_name', 'permission', 'action', 'event',
        'note', 'ip', 'created_at', 'updated_at',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'action_log';

    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @inheritDoc
     */
    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @inheritDoc
     */
    public function getUserName(): string
    {
        return $this->user_name;
    }

    /**
     * @inheritDoc
     */
    public function setUserName(string $user_name)
    {
        $this->user_name = $user_name;
    }

    /**
     * @inheritDoc
     */
    public function getPermission(): string
    {
        return $this->permission;
    }

    /**
     * @inheritDoc
     */
    public function setPermission(string $permission)
    {
        $this->permission = $permission;
    }

    /**
     * @inheritDoc
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @inheritDoc
     */
    public function setAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * @inheritDoc
     */
    public function getEvent(): string
    {
        return $this->event;
    }

    /**
     * @inheritDoc
     */
    public function setEvent(string $event)
    {
        $this->event = $event;
    }

    /**
     * @inheritDoc
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @inheritDoc
     */
    public function setNote(string $note = null)
    {
        $this->note = $note;
    }

    /**
     * @inheritDoc
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @inheritDoc
     */
    public function setIp(string $ip)
    {
        $this->ip = $ip;
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->created_at);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($value)
    {
        $this->created_at = $value;
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): Carbon
    {
        return Carbon::parse($this->updated_at);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt($value)
    {
        $this->updated_at = $value;
    }
}

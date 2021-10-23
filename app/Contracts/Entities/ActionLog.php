<?php

namespace App\Contracts\Entities;

use Carbon\Carbon;

interface ActionLog extends BaseEntity
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
    public function setUserId(int $user_id);

    /**
     * @return string
     */
    public function getUserName(): string;

    /**
     * @param string $user_name
     */
    public function setUserName(string $user_name);

    /**
     * @return string
     */
    public function getPermission(): string;

    /**
     * @param string $permission
     */
    public function setPermission(string $permission);

    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @param string $action
     */
    public function setAction(string $action);

    /**
     * @return string
     */
    public function getEvent(): string;

    /**
     * @param string $event
     */
    public function setEvent(string $event);

    /**
     * @return string
     */
    public function getNote(): ?string;

    /**
     * @param string $note
     */
    public function setNote(string $note = null);

    /**
     * @return string
     */
    public function getIp(): string;

    /**
     * @param string $ip
     */
    public function setIp(string $ip);

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon;

    /**
     * @param  $value
     */
    public function setCreatedAt($value);

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon;

    /**
     * @param  $value
     */
    public function setUpdatedAt($value);
}

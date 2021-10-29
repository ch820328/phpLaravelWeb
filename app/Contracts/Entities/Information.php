<?php

namespace App\Contracts\Entities;

use Carbon\Carbon;

interface Information extends BaseEntity
{

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     */
    public function setId(int $id): void;

    /**
     * @return string
     */
    public function getPage(): string;

    /**
     * @param string $page
     */
    public function setPage(string $page): void;

    /**
     * @return string
     */
    public function getTab(): string;

    /**
     * @param string $tab
     */
    public function setTab(string $tab): void;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     */
    public function setType(string $type): void;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;

    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @param string $url
     */
    public function setUrl(string $url): void;

    /**
     * @return string
     */
    public function getNote(): string;

    /**
     * @param string $note
     */
    public function setNote(string $note): void;

    /**
     * @return Carbon
     */
    public function getDeletedAt(): Carbon;


    /**
     * @param Carbon $deleted_at
     */
    public function setDeletedAt(Carbon $deleted_at): void;
}

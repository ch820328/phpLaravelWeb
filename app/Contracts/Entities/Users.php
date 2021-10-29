<?php

namespace App\Contracts\Entities;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Users extends BaseEntity, Authenticatable, Authorizable, Roles
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return BelongsToMany
     */
    public function getRole(): BelongsToMany;
}

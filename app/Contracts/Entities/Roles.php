<?php

namespace App\Contracts\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Contracts\Role;
use Illuminate\Support\Collection;

interface Roles
{
    public function roles(): BelongsToMany;

    /**
     * Assign the given role to the model.
     *
     * @param array|string|int|Role ...$roles
     *
     * @return $this
     */
    public function assignRole(...$roles);

    /**
     * Revoke the given role from the model.
     *
     * @param string|int|Role $role
     */
    public function removeRole(string|int|Role $role);

    /**
     * Remove all current roles and set the given ones.
     *
     * @param  array|Role|string|int  ...$roles
     *
     * @return $this
     */
    public function syncRoles(...$roles);

    /**
     * Determine if the model has (one of) the given role(s).
     *
     * @param string|int|array|Role|Collection $roles
     * @param string|null                      $guard
     *
     * @return bool
     */
    public function hasRole(Role|int|array|string|Collection $roles, string $guard = null): bool;
}

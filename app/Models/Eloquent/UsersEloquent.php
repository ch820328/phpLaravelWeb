<?php

namespace App\Models\Eloquent;

use App\Contracts\Entities\Users;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int         $id
 * @property string      $name
 * @property string      $email
 * @property string|null $email_verified_at
 * @property string      $password
 * @property string      $remember_token
 * @property mixed       $created_at
 * @property mixed       $updated_at
 */
class UsersEloquent extends Authenticatable implements Users
{
    use Notifiable, HasRoles;

    protected string $guard_name = 'web';

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function getRole(): BelongsToMany
    {
        return $this->roles();
    }
}

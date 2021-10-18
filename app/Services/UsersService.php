<?php

namespace App\Services;

use App\Contracts\Entities\Users;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Contracts\Role;
use UsersRepo;
use RoleRepo;

class UsersService
{
    /**
     * @param string $username
     *
     * @return Users|null
     */
    public function findByUsername(string $username): ?Users
    {
        return UsersRepo::findByUserName($username);
    }

    /**
     * @param int $id
     *
     * @return Users|null
     */
    public function findById(int $id): ?Users
    {
        return UsersRepo::findById($id);
    }

    /**
     * @return Collection|Users[]|null
     */
    public function getAllUsers(): ?Collection
    {
        return UsersRepo::all();
    }

    /**
     * @return Collection|Role
     */
    public function getRoles(): Collection|Role
    {
        return RoleRepo::all();
    }

    /**
     * @param $userName
     *
     * @return string
     */
    public function getUserMappingColor($userName): string
    {
        $result       = 'gray';
        $colorMapping = [
            'SepanTsai' => 'red'
        ];
        if (array_key_exists($userName, $colorMapping)) {
            $result = $colorMapping[$userName];
        }
        return $result;
    }

    /**
     * @return array
     */
    public function getUserList(): array
    {
        $user_array = [];
        $userList   = $this->getAllUsers();
        foreach ($userList as $userInfo) {
            $userName             = $userInfo->getName();
            $userNameMappingColor = $this->getUserMappingColor($userName);
            $user = [
                "name"  => $userName,
                "color" => $userNameMappingColor,
            ];

            $user_array[] = $user;
        }

        return $user_array;
    }
}

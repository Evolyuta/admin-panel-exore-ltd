<?php

namespace App\Normalizer;

use Illuminate\Support\Facades\Hash;

class CreateUserNormalizer
{
    /**
     * Normalizing user request data before inserting
     *
     * @param mixed $user
     * @return array
     */
    public function normalize($user): array
    {
        return [
            'name'       => $user['name'],
            'email'      => $user['email'],
            'password'   => Hash::make($user['password']),
            'is_manager' => $this->getIsManager($user),
            'manager_id' => $this->getManagerId($user),
        ];
    }

    /**
     * Getting is manager value
     *
     * @param $user
     * @return bool
     */
    private function getIsManager($user): bool
    {
        if (!empty($user['is_manager'])) {
            return true;
        }

        return false;
    }

    /**
     * Getting manager id value
     *
     * @param $user
     * @return int|null
     */
    private function getManagerId($user): ?int
    {
        if (!empty($user['manager_id'])) {
            return (int)$user['manager_id'];
        }

        return null;
    }
}

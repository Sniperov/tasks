<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getUserByUsername(string $username)
    {
        return User::where('username', $username)
            ->first();
    }
}
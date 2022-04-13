<?php

namespace App\Services;

use App\Presenters\v1\UserPresenter;
use App\Repositories\UserRepository;

class AuthService extends BaseService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();   
    }

    public function login(array $data) : array
    {
        $user = $this->userRepository->getUserByUserName($data['username']);
        if (is_null($user)) {
            return $this->errNotFound('Неверные имя пользователя или пароль');
        }
        
        if (! $token = auth('api')->attempt($data)) {
            return $this->error(401, 'Неверные имя пользователя или пароль');
        }

        return $this->result([
            'token' => $token,
            'user' => (new UserPresenter($user))->detail(),
        ]);
    }
}
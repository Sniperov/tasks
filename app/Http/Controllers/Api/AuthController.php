<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController extends ApiController
{
    private AuthService $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        return $this->result($this->authService->login($data));
    }
}
<?php

namespace App\Repositories\Auth;

use App\Http\Requests\UserAuthenticationRequest;

interface AuthRepositoryInterface
{
    public function createOrLogin(UserAuthenticationRequest $request);
}

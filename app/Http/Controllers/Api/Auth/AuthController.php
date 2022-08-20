<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAuthenticationRequest;
use App\Repositories\Auth\AuthRepositoryInterface;
use Auth;


class AuthController extends Controller
{
    public function __construct(public ApiResponse $apiResponse, public AuthRepositoryInterface $authRepository){}

    function registerOrLogin(UserAuthenticationRequest $request)
    {
        try
        {
            $user = $this->authRepository->createOrLogin($request);
            return $this->apiResponse->setSuccess(__("Success Login"))->setData($user)->getJsonResponse();
        } catch (\Exception $exception)
        {
            return $this->apiResponse->setError(__($exception->getMessage()))->setData()->getJsonResponse();
        }
    }


}


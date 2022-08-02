<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParentUserLoginRequest;
use App\Http\Requests\ParentUserRegisterRequest;
use App\Models\ParentUser;

/**
 * @group Auth Parents
 * @unauthenticated
 * API for parents to log in and register
 */

class ParentUserAuthController extends Controller
{
    /**
     * Register a ParentUser.
     *
     * Allow the parentUser to Register
     *
     * @responseField token_type "Bearer"
     * @responseField token "Token"
     */
    public function register(ParentUserRegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();


        $parentUser = ParentUser::create($data);

        $token = $parentUser
            ->createToken('auth_token');

        return grantToken($token);
    }

    /**
     * Login a ParentUser.
     *
     * Allow the parentUser to Login
     * @response 401 scenario="Unauthenticated" {"error": "Unauthorized"}
     *
     * @responseField token_type "Bearer"
     * @responseField token "Token"
     */
    public function login(ParentUserLoginRequest $request)
    {
        $data = $request->validated();

        $parentUser = ParentUser::where(key($data), $data[key($data)])->firstOrFail();


        $token = $parentUser
            ->createToken('auth_token');

        return grantToken($token);
    }
}

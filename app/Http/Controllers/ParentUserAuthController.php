<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParentUserLoginRequest;
use App\Http\Requests\ParentUserRegisterRequest;
use App\Models\ParentUser;

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
        if (!canLogin('parentUser', ['id'])) {
            return unauthorized();
        }

        $parentUser = ParentUser::where('id', $request['id'])->firstOrFail();


        $token = $parentUser
            ->createToken('auth_token');

        return grantToken($token);
    }
}
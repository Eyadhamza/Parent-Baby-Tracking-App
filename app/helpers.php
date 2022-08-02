<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('validationFailed')) {
    function validationFailed($errors): JsonResponse
    {
        return response()
            ->json([
                'status' => 'error',
                'errors' => $errors,
            ], 422);
    }
}

if (!function_exists('grantToken')) {
    function grantToken($token): JsonResponse
    {
        return response()
            ->json([
                'data' => [
                    'access_token' => $token->plainTextToken,
                    'token_type' => 'Bearer',
                ],
            ]);
    }
}
if (!function_exists('canLogin')) {
    function canLogin($guard, array $credentials, $remember = null)
    {
        return auth($guard)
            ->attempt(request()->only($credentials, $remember));
    }
}
if (!function_exists('unauthorized')) {
    function unauthorized()
    {
        return response()
            ->json(['data' => ['error' => 'Unauthorized']], 401);
    }
}
if (!function_exists('createdSuccessfullyResponse')) {
    function createdSuccessfullyResponse(string $message = null): JsonResponse
    {
        return response()
            ->json([
                'data' => [
                    'message' => $message ?? 'Resource Created Successfully',
                ],
            ], 201);
    }
}
if (!function_exists('updatedSuccessfullyResponse')) {
    function updatedSuccessfullyResponse(string $message = null): JsonResponse
    {
        return response()
            ->json([
                'data' => [
                    'message' => $message ?? 'Resource Updated Successfully',
                ],
            ], 200);
    }
}
if (!function_exists('deletedSuccessfullyResponse')) {
    function deletedSuccessfullyResponse(): JsonResponse
    {
        return response()
            ->json([
                'data' => [
                    'message' => $message ?? 'Resource Deleted Successfully',
                ],
            ], 200);
    }
}

if (!function_exists('guard')) {
    function guard()
    {
        return config('fortify.guard') ?? auth()->guard();
    }
}
if (!function_exists('withGuardPrefix')) {
    function withGuardPrefix(string $path = ''): string
    {
        $guard = guard();

        return $guard . '.' . $path;
    }
}

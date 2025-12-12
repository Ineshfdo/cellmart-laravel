<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // Check if user is admin
        if (auth()->user()->isAdmin()) {
            return $request->wantsJson()
                ? new JsonResponse('', 204)
                : redirect()->intended('/dashboard');
        }

        // Regular user goes to home page
        return $request->wantsJson()
            ? new JsonResponse('', 204)
            : redirect()->intended('/');
    }
}

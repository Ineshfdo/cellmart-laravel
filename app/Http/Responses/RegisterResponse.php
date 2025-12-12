<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // Check if user is admin (unlikely for new registration, but just in case)
        if (auth()->user()->isAdmin()) {
            return $request->wantsJson()
                ? new JsonResponse('', 201)
                : redirect('/dashboard');
        }

        // Regular user goes to home page after registration
        return $request->wantsJson()
            ? new JsonResponse('', 201)
            : redirect('/');
    }
}

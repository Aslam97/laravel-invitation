<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Get current user loggedIn
     *
     * @return \App\Http\Resources\UserResource
     */
    public function index()
    {
        $currentUser = auth()->user();
        return new UserResource($currentUser);
    }
}

<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function ($route) {

    $route->get('/user', [Controllers\UserController::class, 'index']);

    $route->get('/events', [Controllers\EventController::class, 'index']);
    $route->get(
        '/events/{id}',
        [Controllers\EventController::class, 'show']
    )->withoutMiddleware('auth:sanctum');

    $route->get('/invitations', [Controllers\InvitationController::class, 'index']);
    $route->post('/invitations', [Controllers\InvitationController::class, 'store']);
    $route->post(
        '/invitations/validate',
        [Controllers\InvitationController::class, 'validateCode']
    )->withoutMiddleware('auth:sanctum');
});

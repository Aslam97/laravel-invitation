<?php

namespace App\Http\Controllers;

use App\Http\Request\StoreInvitationRequest;
use App\Http\Resources\InvitationResource;
use App\Invitation;
use Illuminate\Support\Arr;

class InvitationController extends Controller
{
    public function create(StoreInvitationRequest $request)
    {
        $validatedData = $request->validated();

        $code = substr(md5(rand(0, 9) . $validatedData['email'] . time()), 0, 32);
        $invitation = Invitation::create(Arr::add($validatedData, ['code' => $code]));

        return (new InvitationResource($invitation))->additional([
            'message' => 'Invitation sended.',
        ]);
    }
}

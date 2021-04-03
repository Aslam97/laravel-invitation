<?php

namespace App\Http\Controllers;

use App\Events\InvitationCreated;
use App\Http\Requests\StoreInvitationRequest;
use App\Http\Resources\InvitationResource;
use App\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    /**
     * Store invitation
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Http\Resources\InvitationResource
     */
    public function store(StoreInvitationRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['code'] = $this->generateInvitationCode();

        event(new InvitationCreated($invitation = $this->create($validatedData)));

        return (new InvitationResource($invitation))->additional([
            'message' => 'Invitation sended.',
        ]);
    }

    /**
     * Create a new invitation instance.
     *
     * @param  array  $data
     * @return \App\Invitation
     */
    public function create(array $data)
    {
        return Invitation::create([
            'event_id' => $data['event_id'],
            'email' => $data['email'],
            'code' => $data['code'],
        ]);
    }

    /**
     * Validate invitation code
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Http\Resources\InvitationResource
     */
    public function validateCode(Request $request)
    {
        $validatedData = $request->validate(['code' => 'required']);

        $invitation = Invitation::where('code', $validatedData['code'])->firstOrFail();
        return new InvitationResource($invitation);
    }

    /**
     * Generate invitation code
     *
     * @return string
     */
    public function generateInvitationCode()
    {
        return md5(uniqid('', true));
    }
}

<?php

namespace App\Http\Resources;

use App\Http\Resources\InvitationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $parent = parent::toArray($request);
        $parent['invitations'] = InvitationResource::collection($this->whenLoaded('invitations'));

        return $parent;
    }
}

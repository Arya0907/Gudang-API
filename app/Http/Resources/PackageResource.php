<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tracking_number' => $this->tracking_number,
            'sender' => new UserResource($this->sender),
            'receiver' => $this->receiver ? new UserResource($this->receiver) : null,
            'status' => $this->status,
        ];
    }
}
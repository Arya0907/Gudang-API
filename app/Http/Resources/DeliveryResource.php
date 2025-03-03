<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id' => $this->id,
            'package' => new PackageResource($this->package), // Relasi dengan package
            'kurir' => new UserResource($this->kurir), // Relasi dengan kurir (user)
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
<?php

namespace App\Services;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DeliveryCollection extends ResourceCollection
{
    public function toArray($Request)
    {
        return parent::toArray($Request);
    }
}
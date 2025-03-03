<?php

namespace App\Services;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PackageCollection extends ResourceCollection
{
    public function toArray($Request)
    {
        return parent::toArray($Request);
    }
}
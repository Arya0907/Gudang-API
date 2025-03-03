<?php

namespace App\Services;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function toArray($Request){
        return parent::toArray($Request);
    }
}
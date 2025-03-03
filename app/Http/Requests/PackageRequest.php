<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class PackageRequest
{
    public static function validate(Request $request)
    {
        return $request->validate([
            'tracking_number' => 'required|string|unique:packages,tracking_number',
            'sender_id' => 'required|exists:users,id',
            'receiver_name' => 'required|string|max:255',
            'receiver_address' => 'required|string',
            'receiver_phone' => 'required|string|max:15',
            'weight' => 'required|numeric|min:0.1',
            'status' => 'required|in:pending,on delivery,delivered',
        ]);
    }
}
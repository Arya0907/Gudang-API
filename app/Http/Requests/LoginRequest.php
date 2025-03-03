<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory;

class LoginRequest
{
    public static function validate(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
        $validator = app(Factory::class)->make($request->all(), $rules);

        if ($validator->fails()) {
            response()->json($validator->errors(), 400)->send();
            exit;
        } else {
            return $validator->validated();
        }
    }
}
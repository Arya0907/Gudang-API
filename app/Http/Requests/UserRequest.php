<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory;

class UserRequest
{
    public static function validate(Request $request)
    {
        $request['role'] =$request->role ?? 'pelanggan';
         $rules =[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:' . implode(',', [User::ADMIN, User::KURIR, User::PELANGGAN]),
            'password' => 'required|string|min:6',
        ];
          $validator = app( Factory::class )->make($request->all(),$rules);

        if($validator->fails()){
            response()->json($validator->errors(),400)->send();
            exit;
        }else {
            return $validator->validated();
        }
    }
}
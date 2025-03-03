<?php 
namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Factory;
use illuminate\Http\Request;
use Auth;

class DeliveryRequest
{
    public function authorize(): bool
    {
        return Auth::user() && Auth::user()->role === 'kurir';
    }

    public static function validate(Request $request)
    {
        
         $rules =[
            'user_id' => 'required|exists:users,id',
            'package_id' => 'required|exists:packages,id',
            'status' => 'required|in:on the way,delivered,failed'
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

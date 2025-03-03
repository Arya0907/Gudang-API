<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Auth;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        try {
            $users = $this->userService->index();  
            return response()->json(UserResource::collection($users), 200);
        }catch (\Exception $err) {
            return response()->json( $err->getMessage(), 400);
        }
    }

    public function show($id)
    {
        try {
            $user = $this->userService->show($id);  
            return response()->json( new UserResource($user), 200);
        }catch (\Exception $err) {
            return response()->json( $err->getMessage(), 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $payload = UserRequest::validate($request);
            $user = $this->userService->store($payload);
            return response()->json( new UserResource($user), 200);
        }catch (\Exception $err) {
            return response()->json( $err->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = $this->userService->update($id, $request->all());  
            return response()->json( new UserResource($user), 200);
        }catch (\Exception $err) {
            return response()->json( $err->getMessage(), 400);
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->userService->delete($id);  
            return response()->json( new UserResource($user), 200);
        }catch (\Exception $err) {
            return response()->json( $err->getMessage(), 400);
        }
    }

    public function login(Request $request)
    {
        try {
            $payload = LoginRequest::Validate($request);
            $user = $this->userService->login($payload);
            return response()->json( $user, 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function register(Request $request)
    {
        try {
            $payload = UserRequest::Validate($request);
            $user = $this->userService->register($payload);
            return response()->json( $user, 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function logout()
    {
        try {
            $user = JWTAuth::parseToken()->invalidate();
            return response()->json( $user, 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function me()
    {
        try {
            $user = Auth::user();
            return response()->json( new UserResource($user), 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function deleteProfile()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $user->delete();
            JWTAuth::invalidate(JWTAuth::getToken());

        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $payload = UserRequest::Validate($request);
            $user = JWTAuth::parseToken()->authenticate();
            $user = $this->userService->update($user->id, $payload);
            return response()->json(new UserResource($user), status: 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

}

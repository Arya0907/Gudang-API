<?php

namespace App\Services;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->userRepository->getAllUsers();
    }

    public function show($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function store($data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->createUser($data);
    }

    public function update($id, $data)
    {
        return $this->userRepository->updateUser($id, $data);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    public function login($data)
    {
        $token = Auth::attempt($data);
        if(!$token) {
            return response()->json("login gagal silakan cek gmail atau password", 400)->send();
            exit;
        }
        $responseToken = [
            "access_token" => $token,
            "token_type" => "Bearer",
            "user" => Auth::user(),
        ];

        return $responseToken;
    }

    public function register(array $data){
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->createUser($data);
    }

    public function logout(){
      return $this->userRepository->getUserById(Auth::user()->id->logout());
    }

    public function me(){
        return $this->userRepository->getUserById(Auth::user()->id);
    }

    public function updateProfile($id, $data){
        return $this->userRepository->getUserById(Auth::user()->id)->update($data);
    }

    public function deleteProfile($id){
        return $this->userRepository->getUserById(Auth::user()->id)->delete();
    }


}
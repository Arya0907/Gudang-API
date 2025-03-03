<?php
namespace App\Repositories;
use App\Models\User;

class UserRepository
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function createUser($data)
    {
        return User::create($data);
    }

    public function updateUser($id, $data)
    {
       User::where('id', $id)->update($data);
       return User::find($id);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id); // Ambil user berdasarkan ID
        $user->forceDelete();
        return $user;
    }
}
<?php

namespace App\Services;


use App\Models\User;


class UserService
{
    public function registerUser(array $validatedData): User
    {
        return User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
    }
}
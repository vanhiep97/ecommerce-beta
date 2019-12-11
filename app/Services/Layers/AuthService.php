<?php
namespace App\Services\Layers;

class AuthService
{
    public function __construct()
    {
        auth()->shouldUse('admin');
    }

    public function login(array $data)
    {
        return auth()->attempt($data);
    }

    public function logout()
    {
        return auth()->logout();
    }
}

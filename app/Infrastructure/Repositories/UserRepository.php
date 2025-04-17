<?php

namespace App\Infrastructure\Repositories;

use App\Core\Domain\Entities\User;
use App\Core\Application\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository implements AuthServiceInterface
{
    public function register(User $user): void
    {
        \App\Models\User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ]);
    }

    public function login(string $email, string $password): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function getUser(): ?User
    {
        $user = Auth::user();
        return $user ? new User($user->name, $user->email, '') : null;
    }
}
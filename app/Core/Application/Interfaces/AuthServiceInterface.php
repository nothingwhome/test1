<?php

namespace App\Core\Application\Interfaces;

use App\Core\Domain\Entities\User;

interface AuthServiceInterface
{
    public function register(User $user): void;
    public function login(string $email, string $password): bool;
    public function logout(): void;
    public function getUser(): ?User;
}
<?php

namespace App\Core\Application\UseCases;

use App\Core\Domain\Entities\User;
use App\Core\Application\Interfaces\AuthServiceInterface;

class RegisterUserUseCase
{
    public function __construct(
        private AuthServiceInterface $authService
    ) {}

    public function execute(string $name, string $email, string $password): void
    {
        $user = new User($name, $email, bcrypt($password));
        $this->authService->register($user);
    }
}
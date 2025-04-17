<?php

namespace App\Providers;

use App\Core\Application\Interfaces\AuthServiceInterface;
use App\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AuthServiceInterface::class, UserRepository::class);
    }

    public function boot()
    {
        //
    }
}
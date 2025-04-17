<?php

namespace App\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Core\Application\UseCases\RegisterUserUseCase;
use App\Infrastructure\Http\Requests\RegisterRequest;
use App\Core\Application\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private RegisterUserUseCase $registerUseCase,
        private AuthServiceInterface $authService
    ) {}

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $this->registerUseCase->execute(
            $request->name,
            $request->email,
            $request->password
        );

        return redirect('/home');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
    
        // Pastikan data yang dikirim ke repository
        $email = $validated['email'];
        $password = $validated['password'];
    
        if ($this->authService->login($email, $password)) {
            return redirect()->intended('/home');
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect('/login');
    }
}
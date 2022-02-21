<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Traits\ApiResponder;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use ApiResponder;

    /**
     * @var AuthService
     */
    private AuthService $auth_service;

    /**
     * @param AuthService $auth_service
     */
    public function __construct(AuthService $auth_service)
    {
        $this->auth_service = $auth_service;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $this->auth_service->createUser($request);

        return $this->response(__('messages.saved'));
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->auth_service->login($request->only(['username', 'password']));

        $user = $this->auth_service->getUser();

        return $this->response(__('messages.success'), [
            'name' => $user->getAttribute('name'),
            'role' => $user->role(),
            'access_token' => $token,
            'expires_in' => config('jwt.ttl') * 60
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->auth_service->logout();

        return $this->response(__('messages.logged_out'));
    }
}

<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Librarian;
use App\Models\Reader;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * @var Authenticatable
     */
    private Authenticatable $user;

    /**
     * @param Request $request
     * @return void
     */
    public function createUser(Request $request): void
    {
        switch ($request->get('role_id')) {
            case Librarian::ROLE_ID:
                $this->saveUser($request, new Librarian());
                break;
            case Reader::ROLE_ID:
                $this->saveUser($request, new Reader());
                break;
        }
    }

    /**
     * @param array $credentials
     * @return string|null
     * @throws AuthenticationException
     */
    public function login(array $credentials): ?string
    {
        if ($token = Auth::guard('librarians')->attempt($credentials)) {
            $this->user = Auth::guard('librarians')->user();
        } else if ($token = Auth::guard('readers')->attempt($credentials)) {
            $this->user = Auth::guard('readers')->user();
        } else {
            throw new AuthenticationException(__('messages.auth.invalid_credentials'));
        }

        return (string)$token;
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        $guard = getAuthGuard();

        $guard->logout();
    }

    /**
     * @return Authenticatable
     */
    public function getUser(): Authenticatable
    {
        return $this->user;
    }

    /**
     * @param Request $request
     * @param Authenticatable $user
     * @return void
     */
    private function saveUser(Request $request, Authenticatable $user): void
    {
        $user = $user->fill([
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'password' => bcrypt($request->get('password')),
        ]);

        $user->save();

        $this->user = $user;
    }
}

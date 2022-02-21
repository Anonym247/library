<?php
declare(strict_types=1);

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;

if (!function_exists('getAuthGuard')) {
    /**
     * @return Guard|StatefulGuard|null
     */
    function getAuthGuard(): Guard|StatefulGuard|null
    {
        if (Auth::guard('librarians')->user()) {
            return Auth::guard('librarians');
        } else if (Auth::guard('readers')->user()) {
            return Auth::guard('readers');
        }

        return null;
    }
}

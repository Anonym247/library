<?php
declare(strict_types=1);

namespace App\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait CentralizedUser
{
    /**
     * @return array|Builder|Collection|Model|null
     */
    public function role(): array|null|Builder|Collection|Model
    {
        return Role::query()->findOrFail(self::ROLE_ID);
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return 'username';
    }
}

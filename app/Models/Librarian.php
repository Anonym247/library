<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\CentralizedUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Librarian extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use CentralizedUser;

    public const ROLE_ID = 1;
    public const HIT_TYPE_NAME = 'best_librarian';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
    ];

    /**
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * @return HasMany
     */
    public function hires(): HasMany
    {
        return $this->hasMany(Hire::class);
    }
}

<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\CentralizedUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Reader extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use CentralizedUser;

    public const ROLE_ID = 2;

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

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeIsNotBlocked(Builder $builder): Builder
    {
        return $builder->whereDoesntHave('hires', function (Builder $builder) {
            return
                $builder
                    ->where(function (Builder $builder) {
                        return $builder->whereNull('return_date')->where('due_date', '<', today());
                    })
                    ->orWhereRaw('return_date > `due_date`');
        });
    }
}

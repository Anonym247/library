<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @var string[]
     */
    protected $hidden = ['author_id', 'created_at', 'updated_at'];

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeInStock(Builder $builder): Builder
    {
        return $builder->whereDoesntHave('hires', function (Builder $builder) {
            return $builder->whereNull('return_date');
        });
    }

    /**
     * @param Builder $builder
     * @param int $reader_id
     * @return Builder
     */
    public function scopeHiredBy(Builder $builder, int $reader_id): Builder
    {
        return $builder->whereHas('hires', function (Builder $builder) use ($reader_id) {
            return $builder->where('reader_id', $reader_id)->whereNull('return_date');
        });
    }

    /**
     * @return HasMany
     */
    public function hires(): HasMany
    {
        return $this->hasMany(Hire::class);
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}

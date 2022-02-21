<?php
declare(strict_types=1);

namespace App\Repositories\Librarian;

use App\Models\Hit;
use App\Models\Librarian;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LibrarianRepository implements LibrarianRepositoryInterface
{
    /**
     * @var array
     */
    private array $with = [];

    /**
     * @var string|null
     */
    private ?string $date_from = null;

    /**
     * @var string|null
     */
    private ?string $date_to = null;

    /**
     * @var string
     */
    private string $order_by = 'id';

    /**
     * @var string
     */
    private string $order_by_direction = 'asc';

    /**
     * @var Librarian
     */
    private Librarian $librarian;

    /**
     * @var array
     */
    private array $withCount;

    /**
     * @param Librarian $librarian
     */
    public function __construct(Librarian $librarian)
    {
        $this->librarian = $librarian;
    }

    /**
     * @return Collection|array
     */
    public function get(): Collection|array
    {
        return $this->librarian::with($this->with)
            ->withCount($this->withCount)
            ->when($this->date_from, fn (Builder $b) => $b->where('created_at', '>=', $this->date_from))
            ->when($this->date_to, fn (Builder $b) => $b->where('created_at', '<=', $this->date_to))
            ->orderBy($this->order_by, $this->order_by_direction)
            ->get();
    }

    /**
     * @param int $id
     * @return Model|Collection|Builder|array|null
     */
    public function getById(int $id): Model|Collection|Builder|array|null
    {
        return $this->librarian::query()->find($id);
    }

    /**
     * @param int $offset
     * @return Model|Builder|null
     */
    public function getWithOffset(int $offset = 0): Model|Builder|null
    {
        return $this->librarian::query()->offset($offset)->first();
    }

    /**
     * @param array $relations
     * @return void
     */
    public function setWith(array $relations = []): void
    {
        $this->with = $relations;
    }

    /**
     * @param array $relations
     * @return void
     */
    public function setWithCount(array $relations = []): void
    {
        $this->withCount = $relations;
    }

    /**
     * @param string $column
     * @param string $direction
     * @return void
     */
    public function setListOrder(string $column, string $direction = 'asc'): void
    {
        $this->order_by = $column;

        $this->order_by_direction = $direction;
    }

    /**
     * @param string|null $date_from
     */
    public function setDateFrom(?string $date_from): void
    {
        $this->date_from = $date_from;
    }

    /**
     * @param string|null $date_to
     */
    public function setDateTo(?string $date_to): void
    {
        $this->date_to = $date_to;
    }

    /**
     * @param int $librarian_id
     * @return void
     */
    public function saveHitLibrarian(int $librarian_id): void
    {
        if (!Hit::query()->where('month', now()->format('Y-m'))->exists()) {
            Hit::query()->updateOrCreate(
                [
                    'month' => now()->format('Y-m'),
                ],
                [
                    'librarian_id' => $librarian_id,
                    'hit_type' => Librarian::HIT_TYPE_NAME,
                ]
            );
        }
    }
}

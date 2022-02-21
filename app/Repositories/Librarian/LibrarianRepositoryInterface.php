<?php
declare(strict_types=1);

namespace App\Repositories\Librarian;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface LibrarianRepositoryInterface
{
    /**
     * @return Collection|array
     */
    public function get(): Collection|array;

    /**
     * @param int $id
     * @return Model|Collection|Builder|array|null
     */
    public function getById(int $id): Model|Collection|Builder|array|null;

    /**
     * @param int $offset
     * @return Model|Builder|null
     */
    public function getWithOffset(int $offset = 0): Model|Builder|null;

    /**
     * @param array $relations
     * @return void
     */
    public function setWith(array $relations = []): void;

    /**
     * @param array $relations
     * @return void
     */
    public function setWithCount(array $relations = []): void;

    /**
     * @param string $column
     * @param string $direction
     * @return void
     */
    public function setListOrder(string $column, string $direction = 'asc'): void;

    /**
     * @param string|null $date_from
     * @return void
     */
    public function setDateFrom(?string $date_from): void;

    /**
     * @param string|null $date_to
     * @return void
     */
    public function setDateTo(?string $date_to): void;

    /**
     * @param int $librarian_id
     * @return void
     */
    public function saveHitLibrarian(int $librarian_id): void;
}

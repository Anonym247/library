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
}

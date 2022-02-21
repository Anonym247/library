<?php
declare(strict_types=1);

namespace App\Repositories\Librarian;

use App\Models\Librarian;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LibrarianRepository implements LibrarianRepositoryInterface
{
    /**
     * @var Librarian
     */
    private Librarian $librarian;

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
        return $this->librarian::query()->get();
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
}

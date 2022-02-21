<?php
declare(strict_types=1);

namespace App\Repositories\Hire;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface HireRepositoryInterface
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
     * @return Model|Builder|null
     */
    public function getLastHire(): Model|Builder|null;

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void;

    /**
     * @param int $reader_id
     * @param int $book_id
     * @return void
     */
    public function setReturnDate(int $reader_id, int $book_id): void;
}

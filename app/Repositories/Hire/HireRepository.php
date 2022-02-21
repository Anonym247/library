<?php
declare(strict_types=1);

namespace App\Repositories\Hire;

use App\Models\Hire;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class HireRepository implements HireRepositoryInterface
{
    /**
     * @var Hire
     */
    private Hire $hire;

    /**
     * @param Hire $hire
     */
    public function __construct(Hire $hire)
    {
        $this->hire = $hire;
    }

    /**
     * @return Collection|array
     */
    public function get(): Collection|array
    {
        return $this->hire::all();
    }

    /**
     * @param int $id
     * @return Model|Collection|Builder|array|null
     */
    public function getById(int $id): Model|Collection|Builder|array|null
    {
        return $this->hire::query()->find($id);
    }

    /**
     * @return Model|Builder|null
     */
    public function getLastHire(): Model|Builder|null
    {
        return $this->hire::query()->latest()->first();
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $hire = new $this->hire;

        $hire->book_id = $data['book_id'];
        $hire->librarian_id = $data['librarian_id'];
        $hire->reader_id = $data['reader_id'];
        $hire->due_date = $data['due_date'];

        $hire->save();
    }

    /**
     * @param int $reader_id
     * @param int $book_id
     * @return void
     */
    public function setReturnDate(int $reader_id, int $book_id): void
    {
        $hire = $this->hire::query()
            ->where('reader_id', $reader_id)
            ->where('book_id', $book_id)
            ->whereNull('return_date');

        $hire->update(['return_date' => Carbon::today()->format('Y-m-d')]);
    }
}

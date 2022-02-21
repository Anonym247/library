<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\Librarian\LibrarianRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LibrarianService
{
    /**
     * @var LibrarianRepositoryInterface
     */
    private LibrarianRepositoryInterface $librarian_repository;

    /**
     * @param LibrarianRepositoryInterface $librarian_repository
     */
    public function __construct(LibrarianRepositoryInterface $librarian_repository)
    {
        $this->librarian_repository = $librarian_repository;
    }

    /**
     * @return Model|Builder|null
     */
    public function getLibrarianOfTheDay(): Model|Builder|null
    {
        $librarians = $this->librarian_repository->get();

        if (count($librarians) < 1) {
            return null;
        }

        $shifts = Carbon::today()->floatDiffInRealDays($librarians->min('created_at'));

        return $this->librarian_repository->getWithOffset((int)ceil($shifts));
    }

    /**
     * @return Collection|array
     */
    public function getLibrariansWithEfficient(): Collection|array
    {
        $this->librarian_repository->setWithCount(['hires']);
        $this->librarian_repository->setListOrder('hires_count', 'desc');
        $this->librarian_repository->setDateFrom(Carbon::now()->startOfMonth()->toDateString());
        $this->librarian_repository->setDateTo(Carbon::now()->endOfMonth()->toDateString());

        return $this->librarian_repository->get();
    }

    /**
     * @param int $librarian_id
     * @return void
     */
    public function setLibrarianAsHit(int $librarian_id): void
    {
        $this->librarian_repository->saveHitLibrarian($librarian_id);
    }
}

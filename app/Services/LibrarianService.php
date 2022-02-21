<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\Librarian\LibrarianRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
}

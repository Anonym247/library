<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\Hire\HireRepositoryInterface;
use Throwable;

class HireService
{
    /**
     * @var HireRepositoryInterface
     */
    private HireRepositoryInterface $hire_repository;

    /**
     * @var LibrarianService
     */
    private LibrarianService $librarian_service;

    /**
     * @param HireRepositoryInterface $hire_repository
     * @param LibrarianService $librarian_service
     */
    public function __construct(HireRepositoryInterface $hire_repository, LibrarianService $librarian_service)
    {
        $this->hire_repository = $hire_repository;
        $this->librarian_service = $librarian_service;
    }

    /**
     * @param array $data
     * @return void
     * @throws Throwable
     */
    public function store(array $data): void
    {
        $librarian = $this->librarian_service->getLibrarianOfTheDay();

        $data['librarian_id'] = $librarian->getKey();

        $this->hire_repository->store($data);
    }

    /**
     * @param int $book_id
     * @return void
     */
    public function giveBack(int $book_id): void
    {
        $reader = getAuthGuard()->user();

        $this->hire_repository->setReturnDate($reader->getAuthIdentifier(), $book_id);
    }
}

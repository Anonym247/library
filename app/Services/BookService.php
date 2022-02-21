<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\Book\BookRepositoryInterface;

class BookService
{
    /**
     * @var BookRepositoryInterface
     */
    private BookRepositoryInterface $book_repository;

    /**
     * @param BookRepositoryInterface $book_repository
     */
    public function __construct(BookRepositoryInterface $book_repository)
    {
        $this->book_repository = $book_repository;
    }

    /**
     * @return mixed
     */
    public function getAvailableBooks(): mixed
    {
        $this->book_repository->setWith(['author']);

        return $this->book_repository->getAvailableBooks();
    }

    /**
     * @param int $book_id
     * @return mixed
     */
    public function isHiredByCurrentReader(int $book_id): mixed
    {
        $reader = getAuthGuard()->user();

        return $this->book_repository->isHiredBy($reader->getAuthIdentifier(), $book_id);
    }

    /**
     * @return mixed
     */
    public function getHiredBooks(): mixed
    {
        $reader = getAuthGuard()->user();

        return $this->book_repository->getHiredBooks($reader->getAuthIdentifier());
    }

    /**
     * @param int $id
     * @return bool
     */
    public function isAvailable(int $id): bool
    {
        return $this->book_repository->checkAvailabilityById($id);
    }
}

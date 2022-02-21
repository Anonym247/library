<?php
declare(strict_types=1);

namespace App\Repositories\Book;

use App\Models\Book;

class BookRepository implements BookRepositoryInterface
{
    /**
     * @var Book
     */
    private Book $book;

    /**
     * @var array
     */
    private array $with = [];

    /**
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * @return mixed
     */
    public function getAvailableBooks(): mixed
    {
        return $this->book::query()->inStock()->with($this->with)->get();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function checkAvailabilityById(int $id): bool
    {
        return $this->book::query()->inStock()->where('id', $id)->exists();
    }

    /**
     * @param array $with
     */
    public function setWith(array $with = []): void
    {
        $this->with = $with;
    }

    /**
     * @param int $reader_id
     * @return mixed
     */
    public function getHiredBooks(int $reader_id): mixed
    {
        return $this->book::query()->hiredBy($reader_id)->with($this->with)->get();
    }

    /**
     * @param int $reader_id
     * @param int $id
     * @return mixed
     */
    public function isHiredBy(int $reader_id, int $id): mixed
    {
        return $this->book::query()->hiredBy($reader_id)->where('id', $id)->exists();
    }
}

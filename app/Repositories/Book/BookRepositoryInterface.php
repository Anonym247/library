<?php
declare(strict_types=1);

namespace App\Repositories\Book;

interface BookRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAvailableBooks(): mixed;

    /**
     * @param int $id
     * @return bool
     */
    public function checkAvailabilityById(int $id): bool;

    /**
     * @param array $with
     * @return void
     */
    public function setWith(array $with = []): void;

    /**
     * @param int $reader_id
     * @return mixed
     */
    public function getHiredBooks(int $reader_id): mixed;

    /**
     * @param int $reader_id
     * @param int $id
     * @return mixed
     */
    public function isHiredBy(int $reader_id, int $id): mixed;
}

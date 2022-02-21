<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\Reader\ReaderRepositoryInterface;

class ReaderService
{
    /**
     * @var ReaderRepositoryInterface
     */
    private ReaderRepositoryInterface $reader_repository;

    /**
     * @param ReaderRepositoryInterface $reader_repository
     */
    public function __construct(ReaderRepositoryInterface $reader_repository)
    {
        $this->reader_repository = $reader_repository;
    }

    /**
     * @return bool
     */
    public function checkReaderAvailability(): bool
    {
        $reader_id = getAuthGuard()->user()->getAuthIdentifier();

        return $this->reader_repository->hasNoOmissions($reader_id);
    }
}

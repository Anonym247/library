<?php
declare(strict_types=1);

namespace App\Repositories\Reader;

interface ReaderRepositoryInterface
{
    /**
     * @param int $reader_id
     * @return bool
     */
    public function hasNoOmissions(int $reader_id): bool;
}

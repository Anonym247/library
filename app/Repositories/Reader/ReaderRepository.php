<?php
declare(strict_types=1);

namespace App\Repositories\Reader;

use App\Models\Reader;

class ReaderRepository implements ReaderRepositoryInterface
{
    /**
     * @param int $reader_id
     * @return bool
     */
    public function hasNoOmissions(int $reader_id): bool
    {
        return Reader::query()
            ->where('id', $reader_id)
            ->isNotBlocked()
            ->exists();
    }
}

<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const LIST = [
        1 => 'librarian',
        2 => 'reader',
    ];

    /**
     * @var string[]
     */
    public $guarded = ['id'];

    /**
     * @var bool
     */
    public $timestamps = false;
}

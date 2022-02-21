<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Librarian;
use Illuminate\Database\Seeder;

class LibrarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (Librarian::query()->count() < 1) {
            Librarian::factory(5)->create();
        }
    }
}

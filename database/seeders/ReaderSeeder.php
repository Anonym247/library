<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Reader;
use Illuminate\Database\Seeder;

class ReaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (Reader::query()->count() < 1) {
            Reader::factory(50)->create();
        }
    }
}

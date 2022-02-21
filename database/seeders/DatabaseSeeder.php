<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(LibrarianSeeder::class);
        $this->call(ReaderSeeder::class);
    }
}

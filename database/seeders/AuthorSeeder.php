<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'William Shakespeare'
            ],
            [
                'id' => 2,
                'name' => 'Agatha Christie'
            ],
            [
                'id' => 3,
                'name' => 'Agatha Christie'
            ],
            [
                'id' => 4,
                'name' => 'Danielle Steel'
            ],
            [
                'id' => 5,
                'name' => 'Harold Robbins'
            ],
            [
                'id' => 6,
                'name' => 'Georges Simenon'
            ],
        ];

        foreach ($data as $datum) {
            Author::query()->updateOrCreate(
                [
                    'id' => $datum['id'],
                    'name' => $datum['name']
                ]
            );
        }
    }
}

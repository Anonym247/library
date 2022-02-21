<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $roles = array_map(function ($id, $name) {
            return [
                'id' => $id,
                'name' => $name,
            ];
        }, array_keys(Role::LIST), Role::LIST);

        Role::query()->insertOrIgnore($roles);
    }
}

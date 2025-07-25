<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateRolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'hr_hod', 'hr'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}

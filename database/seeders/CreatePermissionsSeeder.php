<?php

// database/seeders/CreatePermissionsSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CreatePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'create articles',
            'edit articles',
            'delete articles',
            'view articles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}

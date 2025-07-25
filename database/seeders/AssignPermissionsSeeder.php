<?php

// database/seeders/AssignPermissionsSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $adminPermissions = Permission::all();
        $editorPermissions = Permission::whereIn('name', ['create articles', 'edit articles'])->get();
        $viewerPermissions = Permission::where('name', 'view articles')->get();

        $admin = Role::where('name', 'admin')->first();
        $editor = Role::where('name', 'editor')->first();
        $viewer = Role::where('name', 'viewer')->first();

        $admin?->syncPermissions($adminPermissions);
        $editor?->syncPermissions($editorPermissions);
        $viewer?->syncPermissions($viewerPermissions);
    }
}

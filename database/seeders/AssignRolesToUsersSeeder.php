<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignRolesToUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Example: Assign 'admin' role to user with ID 1
        $adminUser = User::find(1);
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }

        // Example: Assign 'editor' role to user with email
        $editorUser = User::where('email', 'editor@example.com')->first();
        if ($editorUser) {
            $editorUser->assignRole('editor');
        }

        // Example: Assign 'viewer' role to all other users
        $viewerRole = Role::where('name', 'viewer')->first();

        if ($viewerRole) {
            User::whereNotIn('id', [$adminUser?->id, $editorUser?->id])
                ->each(function ($user) use ($viewerRole) {
                    $user->assignRole($viewerRole);
                });
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view-post']);
        Permission::create(['name' => 'create-post']);
        Permission::create(['name' => 'edit-post']);
        Permission::create(['name' => 'delete-post']);
        Permission::create(['name' => 'publish-post']);

        $admin = Role::create(['name' => 'Admin']);
        $author = Role::create(['name' => 'Author']);
        $reader = Role::create(['name' => 'Reader']);

        //assign permissions

        $admin->givePermissionTo(Permission::all());

        $author->givePermissionTo([
            'view-post',
            'create-post',
            'edit-post',
            'delete-post'
        ]);

        // Reader can ONLY view content
        $reader->givePermissionTo('view-post'); // 
    }
}

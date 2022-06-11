<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'show-post']);
        Permission::create(['name' => 'edit-post']);
        Permission::create(['name' => 'add-post']);
        Permission::create(['name' => 'delete-post']);
    }
}

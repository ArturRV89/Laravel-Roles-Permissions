<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superUser = User::create([
            'name' => 'SuperUser',
            'email' => 'superUser@gmail.com',
            'password' => Hash::make('1234567890'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $role = Role::create([
            'name' => 'super-user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $superUser->assignRole($role);
    }
}

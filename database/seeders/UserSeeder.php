<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'مدير النظام']);

        $user = User::create([
            'name' => 'Alofoug Admin',
            'email' => 'info@alofoug.edu.sd',
            'email_verified_at' => now(),
            'password' => bcrypt('admin@alofoug'), // password
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole($role);
    }
}

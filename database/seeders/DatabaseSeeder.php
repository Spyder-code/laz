<?php

namespace Database\Seeders;

use App\Models\Donatur;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            LabelSeeder::class
        ]);
        User::factory(10)->create([
            'role_id' => 2
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ]);
        Donatur::factory(100)->create();
    }
}

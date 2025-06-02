<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    \App\Models\Role::create(['name' => 'Admin']);
    \App\Models\Role::create(['name' => 'Project Manager']);
    \App\Models\Role::create(['name' => 'Team Member']);
    \App\Models\Role::create(['name' => 'Guest']);
}
}

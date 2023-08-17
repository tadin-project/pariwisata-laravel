<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MsGroupsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(MsMenusSeeder::class);
        $this->call(GroupMenusSeeder::class);
    }
}

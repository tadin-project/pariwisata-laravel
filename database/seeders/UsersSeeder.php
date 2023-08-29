<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $table = new User();
        $this->truncate($table->getTable());
        $data = [
            [
                "id" => 1,
                "name" => "Root",
                "email" => "root@gmail.com",
                "username" => "root",
                "password" => Hash::make('root@123'),
                "user_status" => true,
            ], [
                "id" => 2,
                "name" => "Administrator",
                "email" => "admin@gmail.com",
                "username" => "admin",
                "password" => Hash::make('admin@123'),
                "user_status" => true,
            ], [
                "id" => 3,
                "name" => "User 01",
                "email" => "user01@gmail.com",
                "username" => "user01",
                "password" => Hash::make('user01@123'),
                "user_status" => true,
            ],
        ];

        foreach ($data as $v) {
            $table->create($v);
        }

        $this->enableForeignKeys();
    }
}

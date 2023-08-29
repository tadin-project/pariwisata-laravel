<?php

namespace Database\Seeders;

use App\Models\Admin\GroupUsers;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupUsersSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $table = new GroupUsers();
        $this->truncate($table->getTable());
        $data = [];

        for ($g = 1; $g <= 3; $g++) {
            for ($u = 1; $u <= 3; $u++) {
                if ($u == 1) {
                    $data[] = [
                        "group_id" => $g,
                        "user_id" => $u,
                    ];
                } else if ($u == 2) {
                    if ($g == 1) continue;

                    $data[] = [
                        "group_id" => $g,
                        "user_id" => $u,
                    ];
                } else if ($u == 3) {
                    if ($g == 3) {
                        $data[] = [
                            "group_id" => $g,
                            "user_id" => $u,
                        ];
                    }
                }
            }
        }

        $table->insert($data);

        $this->enableForeignKeys();
    }
}

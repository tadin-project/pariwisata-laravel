<?php

namespace Database\Seeders;

use App\Models\Admin\GroupMenus;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupMenusSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $table = new GroupMenus();
        $this->truncate($table->getTable());
        $data = [];

        for ($g = 1; $g <= 3; $g++) {
            for ($m = 1; $m <= 7; $m++) {
                if ($g == 1) {
                    $data[] = [
                        "group_id" => $g,
                        "menu_id" => $m,
                    ];
                } else if ($g == 2) {
                    if ($m == 5) continue;
                    $data[] = [
                        "group_id" => $g,
                        "menu_id" => $m,
                    ];
                } else if ($g == 3) {
                    if (in_array($m, [7])) {
                        $data[] = [
                            "group_id" => $g,
                            "menu_id" => $m,
                        ];
                    }
                }
            }
        }

        $table->insert($data);

        $this->enableForeignKeys();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Admin\MsGroups;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class MsGroupsSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $table = new MsGroups();
        $this->truncate($table->getTable());
        $data = [
            [
                "group_id" => 1,
                "group_kode" => "00",
                "group_nama" => "Root",
                "group_status" => true,
            ], [
                "group_id" => 2,
                "group_kode" => "01",
                "group_nama" => "Administrator",
                "group_status" => true,
            ], [
                "group_id" => 3,
                "group_kode" => "02",
                "group_nama" => "User",
                "group_status" => true,
            ],
        ];

        foreach ($data as $v) {
            $table->create($v);
        }

        $this->enableForeignKeys();
    }
}

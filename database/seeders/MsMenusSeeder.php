<?php

namespace Database\Seeders;

use App\Models\Admin\MsMenus;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MsMenusSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $table = new MsMenus();
        $this->truncate($table->getTable());
        $data = [
            [
                'menu_id' => 1,
                'menu_kode' => '01',
                'menu_nama' => 'Administrator',
                'menu_status' => true,
                'menu_url' => null,
                'menu_jenis' => 2,
                'parent_menu_id' => 0,
            ], [
                'menu_id' => 2,
                'menu_kode' => '01.01',
                'menu_nama' => 'Setting',
                'menu_status' => true,
                'menu_url' => '#',
                'menu_jenis' => 1,
                'parent_menu_id' => 1,
            ], [
                'menu_id' => 3,
                'menu_kode' => '01.01.01',
                'menu_nama' => 'Master Hak Akses',
                'menu_status' => true,
                'menu_url' => 'admin/groups',
                'menu_jenis' => 1,
                'parent_menu_id' => 2,
            ], [
                'menu_id' => 4,
                'menu_kode' => '01.01.02',
                'menu_nama' => 'Master User',
                'menu_status' => true,
                'menu_url' => 'admin/users',
                'menu_jenis' => 1,
                'parent_menu_id' => 2,
            ], [
                'menu_id' => 5,
                'menu_kode' => '01.01.03',
                'menu_nama' => 'Master Menu',
                'menu_status' => true,
                'menu_url' => 'admin/menus',
                'menu_jenis' => 1,
                'parent_menu_id' => 2,
            ], [
                'menu_id' => 6,
                'menu_kode' => '01.01.04',
                'menu_nama' => 'Master App Setting',
                'menu_status' => true,
                'menu_url' => 'admin/settings',
                'menu_jenis' => 1,
                'parent_menu_id' => 2,
            ], [
                'menu_id' => 7,
                'menu_kode' => '00',
                'menu_nama' => 'Dashboard',
                'menu_status' => true,
                'menu_url' => 'dashboard',
                'menu_jenis' => 1,
                'parent_menu_id' => 0,
            ],
        ];

        foreach ($data as $v) {
            $table->create($v);
        }

        $this->enableForeignKeys();
    }
}

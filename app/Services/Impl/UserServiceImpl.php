<?php

namespace App\Services\Impl;

use App\Models\Admin\MsGroups;
use App\Services\Traits\CustomJsonResponse;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;

class UserServiceImpl implements UserService
{
    use CustomJsonResponse;

    public function getData(string $type, string $where = "", string $order = "", string $limit = "", array $column = []): array
    {
        try {
            if ($type == 'total') {
                $slc = "count(*) as total";
            } else {
                $slc = implode(",", $column);
            }
            $sql = "SELECT $slc from users u inner join ms_groups mg on mg.group_id = u.group_id where 0 = 0 $where $order $limit";
            $rawData = DB::select($sql);
            if ($type == "total") {
                $data = $rawData[0]->total;
            } else {
                $data = $rawData;
            }

            return $this->successJsonResponse($data);
        } catch (\Throwable $th) {
            return $this->errorJsonResponse(env("APP_ENV", 'production') == 'production' ? 'Gagal ambil data. Silahkan hubungi Admin' : $th->getMessage(), $th->getTrace());
        }
    }

    public function getGroup(): array
    {
        try {
            $data = MsGroups::where('group_status', true)->orderBy('group_nama', 'asc')->get();

            return $this->successJsonResponse($data);
        } catch (\Throwable $th) {
            return $this->errorJsonResponse(env("APP_ENV", 'production') == 'production' ? 'Gagal ambil data. Silahkan hubungi Admin' : $th->getMessage(), $th->getTrace());
        }
    }
}

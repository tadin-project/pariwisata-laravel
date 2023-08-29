<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Core\AdminCoreC;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class User extends Controller
{
    public $AdminCore;
    public $title = "Master User";
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->AdminCore = new AdminCoreC();
        $this->AdminCore->title($this->title);
        $this->userService = $userService;
    }

    public function index(): View
    {
        $listGroup = [];
        $rawGroup = $this->userService->getGroup();
        if ($rawGroup["status"]) {
            $listGroup = $rawGroup["data"];
        }

        $data = [
            'isi' => 'ok',
            'title' => $this->title,
            'list_group' => $listGroup,
        ];

        $this->AdminCore->view('admin.users', $data);
        return $this->AdminCore->show();
    }

    public function getData(Request $request): JsonResponse
    {
        $aColumns = array(
            'u.id',
            'u.name',
            'u.email',
            'mg.group_nama',
            'u.user_status',
            'u.group_id',
        );

        $columns = $request->columns;
        $search = $request->search;
        $searchVal = addslashes($search["value"]);

        $sWhere = "";
        if (isset($searchVal) && $searchVal != "") {
            $sWhere .= " AND (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= " LOWER(" . $aColumns[$i] . ") LIKE LOWER('%" . ($searchVal) . "%') OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        $rawTotal = $this->userService->getData('total', $sWhere);
        $recordsTotal = 0;
        if ($rawTotal["status"]) {
            $recordsTotal = $rawTotal["data"];
        }

        $length = intval($request->length);
        $length = $length < 0 ? $recordsTotal : $length;
        $start  = intval($request->start);
        $draw   = intval($request->draw);
        $order  = $request->order;

        $records = array();
        $records["aaData"] = array();
        $sOrder = "";
        if (isset($start) && $length != '-1') {
            $sLimit = "limit " . intval($start) . ", " . intval($length);
        }

        if (count($order) > 0) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < count($order); $i++) {
                if ($columns[$order[$i]["column"]]["orderable"] == "true") {
                    $sOrder .= "" . $aColumns[intval($order[$i]["column"])] . " " .
                        ($order[$i]["dir"] === 'asc' ? 'asc' : 'desc') . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }

        $rawData = $this->userService->getData('data', $sWhere, $sOrder, $sLimit, $aColumns);
        $data = [];
        if ($rawData["status"]) {
            $data = $rawData["data"];
        }
        $no   = 1 + $start;
        foreach ($data as $row) {
            $id = $row->id;
            $isi = rawurlencode(json_encode($row));
            if ($row->user_status == 1) {
                $status = '<span class="badge badge-sm bg-success">Aktif</span>';
            } else {
                $status = '<span class="badge badge-sm bg-danger">Non Aktif</span>';
            }

            $action = '<button onclick="fnSetVal(\'' . $isi . '\')"  class="btn btn-sm btn-success m-1 btn-icon"  title="Edit">
							<i class="fa fa-pencil-alt"></i>
						</button>
						<button onclick="fnSetDel(\'' . $id . '\',\'' . $row->name . ' - ' . $row->email . '\')" class="btn btn-sm btn-danger m-1 btn-icon" title="Delete">
							<i class="fa fa-trash"></i>
						</button>';

            $records["aaData"][] = array(
                $no++,
                $row->name,
                $row->email,
                $row->group_nama,
                $status,
                $action
            );
        }

        $records["draw"] = $draw;
        $records["recordsTotal"] = $recordsTotal;
        $records["recordsFiltered"] = $recordsTotal;

        return response()->json($records);
    }
}

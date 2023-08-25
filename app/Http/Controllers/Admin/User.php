<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Core\AdminCoreC;
use Illuminate\Http\Request;

class User extends Controller
{
    public $AdminCore;
    public $title = "Master User";

    public function __construct()
    {
        $this->AdminCore = new AdminCoreC();
        $this->AdminCore->title($this->title);
    }

    public function index(): View
    {
        $data = [
            'isi' => 'ok',
        ];
        $this->AdminCore->view('admin.users', $data);
        return $this->AdminCore->show();
    }
}

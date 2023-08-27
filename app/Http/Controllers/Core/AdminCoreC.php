<?php

namespace App\Http\Controllers\Core;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminCoreC extends PublicCoreC
{
    private $__view;
    private $__title = "";
    private $__toolbar_title = "";

    public function __construct()
    {
    }

    public function show(): View
    {
        $__setting = [];
        $sidebar = view('templates.admin.components.sidebar');

        $app_title = "Metronic";
        if (!empty($this->__title)) {
            $app_title .= " | " . $this->__title;
        }

        $data = [
            "__title" => $app_title,
            "__toolbar_title" => $this->__toolbar_title,
            "__setting" => $__setting,
            "__sidebar" => $sidebar,
            "__view" => !empty($this->__view) ? $this->__view : '',
        ];

        return view('templates.admin.index', $data);
    }

    public function view(string $view, array $data = []): void
    {
        $this->__view = view($view, $data);
    }

    public function title(string $title): void
    {
        $this->__title = $title;
        $this->__toolbar_title = $title;
    }

    public function toolbar_title(string $toolbar_title): void
    {
        $this->__toolbar_title = $toolbar_title;
    }
}

<?php

namespace App\Http\Controllers\Fe;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeC extends Controller
{
    public function index(Request $request): View
    {
        return view('fe.welcome');
    }
}

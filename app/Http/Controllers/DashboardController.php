<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Yajra\Datatables\Datatables;

class DashboardController extends Controller
{
    public function index()
    {
        return view("dashboard.index");
    }

    public function slicing(Request $req){
        try {
            return view("slicing.".$req->nama_blade);
        } catch (\Throwable $th) {
            echo "<h1>ga ada blade view nya ...</h1>";
        }
    }
}

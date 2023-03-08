<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController as AdminController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Models\Admin\Fruit;
use App\Models\Admin\Nutrition;

class DashboardController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return view('admin.fruits.sync');
    }
}

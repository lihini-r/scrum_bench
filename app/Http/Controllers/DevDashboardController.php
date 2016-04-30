<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Sprint;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

class DevDashboardController extends Controller
{

    /**
     * Direct user to Developer Dashboard View
     *
     * @return Developer Dashboard view as Response
     */
    public function index()
    {
        return view('dev_dashboard.index');
    }
}
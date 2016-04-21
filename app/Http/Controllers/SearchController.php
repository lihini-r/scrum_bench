<?php namespace App\Http\Controllers;

use App\Http\Requests;
//use App\Http\Controllers\View;
use App\Sprint;
//use Session;
//use Auth;
//use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

class SearchController extends Controller
{

    /**
     * Direct user to to Advanced Search View
     *
     * @return Search view as Response
     */
    public function index()
    {
        return view('search');
    }
}
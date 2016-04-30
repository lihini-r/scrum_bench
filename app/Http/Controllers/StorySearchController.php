<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Sprint;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

class StorySearchController extends Controller
{

    /**
     * Direct user to to Advanced Search View
     *
     * @return Search index view as Response
     */
    public function index()
    {
        return view('story_search.index');
    }
}
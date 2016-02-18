<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignProjects extends Model {

    protected $fillable = [

        'ProjectName',
        'ProjectManager',
        'TeamName',

    ];



    protected $primaryKey ='id';




}

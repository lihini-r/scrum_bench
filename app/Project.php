<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $fillable = [
        'ProjectID',
        'ProjectName',
        'Description',
        'State',
        'add_date',
        'due_date',
        'Hide',
    ];



    protected $primaryKey ='ProjectID';



}

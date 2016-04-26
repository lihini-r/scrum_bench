<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $fillable = [
        'ProjectID',
        'ProjectName',
        'Description',
        'State',
        'duration',
        'Hide',
        'acc_name',
        'id',
    ];



    protected $primaryKey ='ProjectID';



}


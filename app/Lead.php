<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model {

    protected $fillable = [

        'ProjectName',
        'ProjectLead',

    ];



    protected $primaryKey ='id';

}

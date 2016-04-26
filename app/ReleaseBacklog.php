<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ReleaseBacklog extends Model {

    protected $fillable = [

        'ProjectName',
        'acc_name',
        'release_date',

    ];



    protected $primaryKey ='id';


}

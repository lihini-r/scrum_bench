<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {



    protected $fillable = [
        'team_id',
        'TeamName',
        'Developers',
        'assigned_state',

    ];



    protected $primaryKey ='team_id';


}

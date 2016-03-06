<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SprintSchedule extends Model {

	//
    protected $fillable = [
        'project_id',

        'story_id',
        'sprint_id'
    ];

}

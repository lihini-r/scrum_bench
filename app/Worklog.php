<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Worklog extends Model {

	//

    protected $fillable = [
        'id',
        'story_id',
        'user_id',
        'work_start_date',
        'work_end_date',
        'description',
        'duration'

    ];

}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model {

	//

    protected $fillable = [
        'id',
        'story_id',
        'user_id',
        'updated_date',
        'status',
        'created_at'



    ];

}

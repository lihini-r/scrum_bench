<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStory extends Model {

	//

    protected $fillable = [
        'project_id',
        'summary',
        'priority',
        'due_date',
        'assignee',
        'reporter',
        'description',
        'org_est',
        'story_id',
        'created_at'
    ];

    protected $primaryKey = 'story_id';

}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model {

	/**
     * Fillable fields
     * 
     * @var array
     */
    protected $fillable = [
        'sprint_name',
        'project_id',
		'start_date',
		'end_date',
        'status'
    ];
}

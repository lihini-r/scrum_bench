<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model {

    protected $fillable = [
        'task',
        'created_at',
        'userName',
        'task_date',
        'color'




    ];

    protected $primaryKey='task_id';

}

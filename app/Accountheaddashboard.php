<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Accountheaddashboard extends Model {

    protected $fillable = [
        'ProjectID',
        'ProjectName',
        'State',
        'pm',
        'Hide',
        'due_date',
        'Description',
        'add_date',
        'acc_name'

    ];

    protected $primaryKey='ProjectID';

}

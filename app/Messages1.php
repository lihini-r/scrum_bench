<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages1 extends Model {

    protected $fillable = [
        'from',
        'message',
        'to'


    ];

    protected $primaryKey='messageid';

}

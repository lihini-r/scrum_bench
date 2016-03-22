<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Eother extends Model {

    protected $fillable = [
        'sender',
        'recipient',
        'subject',
        'message',

    ];//

}

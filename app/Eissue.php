<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Eissue extends Model {
    protected $fillable = [
        'emailFrom',
        'subject',
        'message',

    ];//

}

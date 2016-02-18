<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model {

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'acc_name',
        'description',
        'acc_head'
    ];

}

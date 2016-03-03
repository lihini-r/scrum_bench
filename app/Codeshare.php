<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Codeshare extends Model {

    protected $fillable = [
        'title',
        'language',
        'description',
        'sourceCode'

    ];

    protected $primaryKey='codeId';

}
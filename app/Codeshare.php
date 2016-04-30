<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Codeshare extends Model {

    //columns that are needed to retrieve
    protected $fillable = [
        'title',
        'language',
        'description',
        'sourceCode',
        'userName'
    ];

    //unique retrieval by codeId
    protected $primaryKey='codeId';

}
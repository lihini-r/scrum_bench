<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $fillable = [
        'name',
        'comment',
        'codeId'

    ];

    protected $primaryKey='commentId';

}

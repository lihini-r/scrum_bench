<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

	public function user()
    {
        return $this->belongsTo('User');
    }

    protected $fillable = [
        'id',
        'profile_pic',
        'about',
        'prof_qual',
        'acad_qual',
        'techno'

    ];
}

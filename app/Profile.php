<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Profile extends Model implements LogsActivityInterface{

    use LogsActivity;


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


    /**
     * Get the message that needs to be logged for the given event.
     *
     * @param string $eventName
     *
     * @return string
     */

    public function getActivityDescriptionForEvent($eventName)
    {
        if ($eventName == 'created')
        {
            return ' New user created their profile';
        }

        if ($eventName == 'updated')
        {
            return 'User "' . $this->id . '" updated their profile';
        }

        if ($eventName == 'deleted')
        {
            return 'User "' . $this->id . '" deleted their profile';
        }

        return '';
    }
}

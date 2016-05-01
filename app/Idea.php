<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;


class Idea extends Model implements LogsActivityInterface {

    use LogsActivity;

    protected $fillable = [
        'idea_id',
        'project_id',
        'title',
        'description',
        'priority'
    ];

    protected $primaryKey='idea_id';

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
            return 'Idea "' . $this->title . '" was created';
        }

        if ($eventName == 'updated')
        {
            return 'Idea "' . $this->title . '" was updated';
        }

        if ($eventName == 'deleted')
        {
            return 'Idea "' . $this->title . '" was deleted';
        }

        return '';
    }
}

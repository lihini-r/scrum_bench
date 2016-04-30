<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Account extends Model implements LogsActivityInterface{

    use LogsActivity;

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
            return 'Account "' . $this->acc_name . '" was created';
        }

        if ($eventName == 'updated')
        {
            return 'Account "' . $this->acc_name . '" was updated';
        }

        if ($eventName == 'deleted')
        {
            return 'Account "' . $this->acc_name . '" was deleted';
        }

        return '';
    }


}

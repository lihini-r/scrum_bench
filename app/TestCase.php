<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TestCase extends Model {

    protected $fillable = [
        'TestCaseID',
        'TestCaseName',
        'Scenario',
        'TestSteps',
        'ExpectedOutcome',
        'ActualOutcome',
        'Pass_Fail',
        'Comments',
        'uid',
        'user_story_id',
        'user_story',
    ];



    protected $primaryKey ='TestCaseID';


}

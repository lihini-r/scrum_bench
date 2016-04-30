<?php
namespace App\Helpers;

use App\Http\Controllers\WorklogController;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Auth;
use App\Worklog;

 /* 
  * TimeIndicator abstract class
  */
class TimeIndicator{
    private $story_id;
    private $original_estimate;

    function __construct($story_id,$org_est){
        $this->story_id = $story_id;
        $this->original_estimate = $org_est;
    }
	
	// Any child that extends this class should implement this getMarkup method
    function  getMarkup(){}

    function getStoryId(){
        return $this->story_id;
    }
	
    function getOriginalEstimate(){
        return $this->original_estimate;
    }
}

 /* 
  * TimeIndicatorFactory class helps to genertae relevant TimeIndicator object based on the type parameter
  */
class TimeIndicatorFactory{
    public static function create($type,$story_id,$org_est){
       $timeIndicator = null;
        if(strcmp($type,"Total")==0){
            $timeIndicator = new TotalTimeIndicator($story_id,$org_est);
        }
        else if(strcmp($type,"Remaining")==0){
            $timeIndicator = new RemainingTimeIndicator($story_id,$org_est);
        }
        else if(strcmp($type,"Logged")==0){
            $timeIndicator = new LoggedTimeIndicator($story_id,$org_est);
        }
        return $timeIndicator;
    }
}

 /* 
  * TotalTimeIndicator class wich implements getMarkup method to view total estimated time
  */
class TotalTimeIndicator extends TimeIndicator{
    function getMarkup()
    {
        parent::getMarkup();

        $logged_hrs = WorklogController::getTotalLoggedHours(self::getStoryId());
        $est_hrs = intval(self::getOriginalEstimate());

        $final_style_class = "progress-bar-info";
        $progress_value = 100;

        $outer_div_width = 100;

        if($est_hrs<$logged_hrs){
            $outer_div_width = ($est_hrs/$logged_hrs) * 100;
        }

        $progress_markup = "<div class='progress' style='width:".$outer_div_width."%'>";
        $progress_markup = $progress_markup . "<div class='progress-bar ".$final_style_class."' role='progressbar' aria-valuenow='".$progress_value."'
                                             aria-valuemin='0' aria-valuemax='100' style='width:".$progress_value."%' >";
        $progress_markup = $progress_markup .$est_hrs."h";
        $progress_markup = $progress_markup . "</div>";
        $progress_markup = $progress_markup . "</div>";

        return $progress_markup;
    }
}

 /* 
  * RemainingTimeIndicator class wich implements getMarkup method to view remaining time
  */
class RemainingTimeIndicator extends TimeIndicator{
    function getMarkup()
    {
        parent::getMarkup();

        $logged_hrs = WorklogController::getTotalLoggedHours(self::getStoryId());
        $est_hrs = intval(self::getOriginalEstimate());

        $final_style_class = "progress-bar-warning";

        $outer_div_width = 100;

        if($est_hrs<$logged_hrs){
            $outer_div_width = ($est_hrs/$logged_hrs) * 100;
        }

        $diff = $est_hrs-$logged_hrs;
        $progress_value = ($diff / $est_hrs) * 100;

        $progress_markup = "<div class='progress' style='width:".$outer_div_width."%'>";
        $progress_markup = $progress_markup . "<div class='progress-bar ".$final_style_class."' role='progressbar' aria-valuenow='".$progress_value."'
                                             aria-valuemin='0' aria-valuemax='100' style='width:".$progress_value."%' >";
        $progress_markup = $progress_markup .$diff."h";
        $progress_markup = $progress_markup . "</div>";
        $progress_markup = $progress_markup . "</div>";

        return $progress_markup;
    }
}

 /* 
  * LoggedTimeIndicator class wich implements getMarkup method to view currently logged time
  */
class LoggedTimeIndicator extends TimeIndicator{
    function getMarkup()
    {
        parent::getMarkup();

        $logged_hrs = WorklogController::getTotalLoggedHours(self::getStoryId());
        $est_hrs = intval(self::getOriginalEstimate());

        $progress_value_exc=0;
        $progress_value=0;
        $diff=0;
        $label=0;

        $final_style_class = "progress-bar-success";
        $exceed_style_class = "progress-bar-danger";

        $hasExcessLoggedHours = ($est_hrs<$logged_hrs);

        if($hasExcessLoggedHours){
            $diff = $logged_hrs - $est_hrs;
            $progress_value=($est_hrs / ($est_hrs + $diff)) * 100;
            $progress_value_exc=($diff / ($est_hrs + $diff)) * 100;
            $label=$est_hrs;
        }else {
            $progress_value = ($logged_hrs / $est_hrs) * 100;
            $label=$logged_hrs;
        }

        $progress_markup = "<div class='progress'>";
        $progress_markup = $progress_markup . "<div class='progress-bar ".$final_style_class."' role='progressbar' aria-valuenow='".$progress_value."'
                                             aria-valuemin='0' aria-valuemax='100' style='width:".$progress_value."%' >";
        $progress_markup = $progress_markup .$label."h";
        $progress_markup = $progress_markup . "</div>";
        if($hasExcessLoggedHours) {
            $progress_markup = $progress_markup . "<div class='progress-bar " . $exceed_style_class . "' role='progressbar' aria-valuenow='" . $progress_value . "'
                                             aria-valuemin='0' aria-valuemax='100' style='width:" . $progress_value_exc . "%' >";
            $progress_markup = $progress_markup . $diff . "h";
            $progress_markup = $progress_markup . "</div>";
        }
        $progress_markup = $progress_markup . "</div>";

        return $progress_markup;
    }
}

?>
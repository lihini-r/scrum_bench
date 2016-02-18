<?php

class myclass
{
    private static $WORKFLOW_STATUS_LIST = array("To-Do", "In-Progress", "Testing", "Review", "Resolved", "Closed");
    private static $WORKFLOW_NEXT_STATUS_INDEX_LIST = array("To-Do" => 1, "In-Progress" => 2, "Testing" => 3, "Review" => 4, "Resolved" => 5, "Closed" => 5);
    private static $WORKFLOW_ACTION_LIST = array("To-Do" => "Start", "In-Progress" => "Start Testing", "Testing" => "To Review", "Review" => "Resolve", "Resolved" => "Close", "Closed" => "Hide");

    public static function getNextState($currentState)
    {
        global $WORKFLOW_STATUS_LIST;
        global $WORKFLOW_NEXT_STATUS_INDEX_LIST;
        return $WORKFLOW_STATUS_LIST[$WORKFLOW_NEXT_STATUS_INDEX_LIST[$currentState]];
    }

    public static function getNextAction()
    {
        //global $WORKFLOW_ACTION_LIST;
        $arr = array();
        $arr[] = $GLOBALS['WORKFLOW_ACTION_LIST'];
        //echo $currentState;
        echo $arr['To-Do'];
        return $arr[$currentState];
    }
}


print_r("out : ".myclass::getNextAction());

?>
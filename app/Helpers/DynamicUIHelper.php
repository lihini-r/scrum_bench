<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Auth;
use Log;

class DynamicUIHelper
{
	/**
     * Generates html <select> tag <options> list from a given table
     * The columns which should represent option value and display string can be passed as parameters
	 * Value of the option that should be selected when previewing the drop down can be passed as last parameter
	 *
	 * @param  String $table_name
	 * @param  String $key_column_name
	 * @param  String $value_column_name
	 * @param  String $selected_key
     * @return String which represent html option tags
     */
    public static function getDropDownMarkup($table_name, $key_column_name, $value_column_name, $selected_key)
    {
        $results = DB::table($table_name)->get();
        $option_markup = "";
        $selected_attr = "";
        foreach ($results as $res) {
            if ($selected_key != null) {
                $selected_attr = "selected='selected'";
            } else {
                $selected_attr = "";
            }
            $option_markup = $option_markup . "<option value='" . $res->$key_column_name . "' " . $selected_attr . ">" . $res->$value_column_name . "</option>";
        }
        return $option_markup;
    }

	/**
     * Generates html <select> tag <options> list from data set filtered by a conditioned query performed upon a given table
     * The columns which should represent option value and display string can be passed as parameters
	 * Value of the option that should be selected when previewing the drop down can be passed as last parameter
	 *
	 * @param  String $table_name
	 * @param  String $key_column_name
	 * @param  String $value_column_name
	 * @param  String $condition
	 * @param  String $selected_key
     * @return String which represent html option tags
     */
    public static function getConditionedDropDownMarkup($table_name, $key_column_name, $value_column_name, $condition, $selected_key)
    {
        if (sizeof($condition) != 3) {
            return "Invalid Condition";
        }
        $results = DB::table($table_name)->where($condition[0], $condition[1], $condition[2])->get();
        $option_markup = "";
        $selected_attr = "";
        foreach ($results as $res) {
            if ($selected_key != null) {
                $selected_attr = "selected='selected'";
            } else {
                $selected_attr = "";
            }
            $option_markup = $option_markup . "<option value='" . $res->$key_column_name . "' " . $selected_attr . ">" . $res->$value_column_name . "</option>";
        }
        return $option_markup;
    }

	/**
     * Generates id(key), name(value) associative array from data set filtered by a conditioned query performed upon a given table
     * The columns which should represent id(key) and name(value) can be passed as parameters
	 * Condition that should be used to filter out data from the given table can be passed as last parameter
	 *
	 * @param  String $table_name
	 * @param  String $id_column_name
	 * @param  String $name_column_name
	 * @param  String $condition
     * @return array with id(key), name(value)
     */
    public static function getConditionedIdNameArray($table_name, $id_column_name, $name_column_name, $condition)
    {
        if (sizeof($condition) != 3) {
            return "Invalid Condition";
        }
        $results = DB::table($table_name)->where($condition[0], $condition[1], $condition[2])->get();
        $id_name_array = array();
        foreach ($results as $res) {
            $id_name_array[$res->$id_column_name] = $res->$name_column_name;
        }
        return $id_name_array;
    }

	/**
     * Generates id(key), name(value) associative array from a given table
     * The columns which should represent id(key) and name(value) can be passed as parameters
	 *
	 * @param  String $table_name
	 * @param  String $id_column_name
	 * @param  String $name_column_name
     * @return array with id(key), name(value)
     */
    public static function getIdNameArray($table_name, $id_column_name, $name_column_name)
    {
        $results = DB::table($table_name)->get();
        $id_name_array = array();
        foreach ($results as $res) {
            $id_name_array[$res->$id_column_name] = $res->$name_column_name;
        }
        return $id_name_array;
    }

	/**
     * Generates html markup tags of a bootstrap progressbar element based on a given total value and value for portion of progress
	 *
	 * @param  String $total_hours
	 * @param  String $logged_hours
     * @return String which represent html markup tags of the bootstrap progressbar element
     */
    public static function getProgressMarkup($total_hours, $logged_hours)
    {
        $success_class = "progress-bar-success";
        $danger_class = "progress-bar-yellow";
        $in_progress_class = "progress-bar-primary";
        $label_string = "";
        $final_style_class = "";
        $progress_value = 0;
        $background_color = "#cfcfcf";

        if ($total_hours > $logged_hours) {
            $final_style_class = $in_progress_class;
            $progress_value = ($logged_hours / $total_hours) * 100;
            $label_string = round($progress_value);
        } else if ($total_hours == $logged_hours) {
            $final_style_class = $success_class;
            $progress_value = 100;
            $label_string = "100";
        } else {
            $final_style_class = $danger_class;
            $diff = $logged_hours - $total_hours;
            $progress_value = ($total_hours / ($total_hours + $diff)) * 100;
            $background_color = "#e61414";
            $label_string = "Exceeded by " . round(($diff / ($total_hours + $diff)) * 100);
        }

        $progress_markup = "<div class='progress progress-xs progress-striped active' style='background-color: " . $background_color . "; width: 95%;'>";
        $progress_markup = $progress_markup . "<div class='progress-bar " . $final_style_class . "' style='width: " . $progress_value . "%'></div>";
        $progress_markup = $progress_markup . "</div>";
        $progress_markup = $progress_markup . "<span class='badge bg-red'>" . $label_string . "%</span>";
        return $progress_markup;
    }

	/**
     * Check whether current users designation / role is equal to the user_role value passed as a parameter
	 *
	 * @param  String $user_role
     * @return bool true if current users designation / role is equal to the specified user_role value
     */
    public static function isUserRole($user_role)
    {
        $res_des = Auth::user()->designation;

        $accept = false;
        if ($res_des == $user_role) {
            $accept = true;
        }
        return $accept;
    }

	/**
     * Generates id(key), name(value) associative array from a "projects" table
	 * 
     * @return array with Project Id and Project Name
     */
    public static function getProjectIdNameArray()
    {
        $results = DB::table("projects")->get();
        $id_project_name_array = array();
        foreach ($results as $res) {
            $id_project_name_array[$res->ProjectID] = $res->ProjectName;
        }
        return $id_project_name_array;
    }

	/**
     * Get List of Sprints that currently logged user's team has been assigned to
     * @return List of Sprints
     */
    public static function getSprintsInProjects()
    {
        $res_name = Auth::user()->name;
        $res_des = Auth::user()->designation;
        $res_id = Auth::user()->id;
        $current_team_id = "";
        $result_project = "";
        $result_id = "";
        $project_sprints = array();

        if ($res_des == 'Developer' ) {
			// Get Team that current user has been assigned to
            $result_teams = DB::table('dev_team')->where('user_id', '=', $res_id)->get();

            foreach ($result_teams as $result_team) {
                $current_team_id = $result_team->team_id;
            }

			// Get Project that the Team has been assigned to
            $result_project_ids = DB::table('assign_teams')->where('team_id', '=', $current_team_id)->get();

            foreach ($result_project_ids as $result_project_id) {
                $result_project = $result_project_id->ProjectID;
            }

			Log::info("DynamicUIHelper:getSprintsInProjects - Dev User : " . $res_id . ", team : " . $current_team_id . ", project : " . $result_project);
			
			// Get user Sprints relevant to the resolved Project
            $result_sprints_ids = DB::table('sprints')->where('project_id', '=', $result_project)->get();
            foreach ($result_sprints_ids as $result_sprints_id) {
                $result_id = $result_sprints_id->id;
                $project_sprint = DB::table('sprint_schedules')->where('sprint_id', '=', $result_id)->groupby('sprint_id')->get();
                				
                if (sizeof($project_sprint) > 0) {
                    array_push($project_sprints, $project_sprint[0]);
                }
            }
			
            return $project_sprints;
        }
		
        if ($res_des == 'Project Manager' ) {
			// Get Project that the Project Manager has been assigned to
            $result_project_ids = DB::table('assign_projects')->where('ProjectManager', '=', $res_name)->get();
            foreach ($result_project_ids as $result_project_id) {
                $result_project = $result_project_id->ProjectName;
            }
			
			// Get user Sprints relevant to the resolved Project
            $result_sprints_ids = DB::table('sprints')->where('project_id', '=', $result_project)->get();
			
            foreach ($result_sprints_ids as $result_sprints_id) {
                $result_id = $result_sprints_id->id;
                $project_sprint = DB::table('sprint_schedules')->where('sprint_id', '=', $result_id)->groupby('sprint_id')->get();
                
                if (sizeof($project_sprint) > 0) {
                    array_push($project_sprints, $project_sprint[0]);
                }
            }
			
			Log::info("DynamicUIHelper:getSprintsInProjects - Project Manager : " . $res_id . ", name : " . $res_name . ", project : " . $result_project);
						
            return $project_sprints;
        }
		
        if ($res_des == 'Account Head' || $res_des == 'Administrator') {
			// For Account Heads and Administrators, return all Sprints
            $project_sprint = DB::table('sprint_schedules')->get();
            if (sizeof($project_sprint) > 0) {
                array_push($project_sprints, $project_sprint[0]);
            }
			
			Log::info("DynamicUIHelper:getSprintsInProjects - " . $res_des . ", All Stories will be displayed");
			
            return $project_sprints;
        }
    }

	/**
     * Get List of Developers that a Project Manager's dev team consist with
     * @return List of Developers in the team
     */
    public static function getDevelopers()
    {
        $res_des = Auth::user()->designation;
        $res_name = Auth::user()->name;
        $current_project_id = "";
        $result_teamId = "";
        $result_ids = "";

		// Get Project that the Current User has been assigned to
        $result_projects = DB::table('assign_projects')->where('name', '=', $res_name)->get();

        foreach ($result_projects as $result_project) {
            $current_project_id = $result_project->ProjectName;
        }

		// Get Team relevant to the resolved Project
        $result_team_ids = DB::table('assign_teams')->where('ProjectID', '=', $current_project_id)->get();

        foreach ($result_team_ids as $result_team_id) {
            $result_teamId = $result_team_id->team_id;
        }

		// Get Team entries (Developers in the team)
        $result_dev_ids = DB::table('dev_team')->where('team_id', '=', $result_teamId)->get();

        return $result_dev_ids;
    }
}

?>
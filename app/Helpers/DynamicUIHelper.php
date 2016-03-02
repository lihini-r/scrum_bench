<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Auth;

class DynamicUIHelper
{

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

    public static function getIdNameArray($table_name, $id_column_name, $name_column_name)
    {
        $results = DB::table($table_name)->get();
        $id_name_array = array();
        foreach ($results as $res) {
            $id_name_array[$res->$id_column_name] = $res->$name_column_name;
        }
        return $id_name_array;
    }

    public static function getProgressMarkup($total_hours, $logged_hours)
    {
        $success_class = "progress-bar-success";
        $danger_class = "progress-bar-yellow";
        $in_progress_class = "progress-bar-primary";
        $final_style_class = "";
        $progress_value = 0;
        $background_color = "#cfcfcf";

        if ($total_hours > $logged_hours) {
            $final_style_class = $in_progress_class;
            $progress_value = ($logged_hours / $total_hours) * 100;
        } else if ($total_hours == $logged_hours) {
            $final_style_class = $success_class;
            $progress_value = 100;
        } else {
            $final_style_class = $danger_class;
            $diff = $logged_hours - $total_hours;
            $progress_value = ($total_hours / ($total_hours + $diff)) * 100;
            $background_color = "#e61414";
        }

        $progress_markup = "<div class='progress progress-xs progress-striped active' style='background-color: " . "; width: 95%;'>";
        $progress_markup = $progress_markup . "<div class='progress-bar " . $final_style_class . "' style='width: " . $progress_value . "%'></div>";
        $progress_markup = $progress_markup . "</div>";
        $progress_markup = $progress_markup . "<span class='badge bg-red'>" . round($progress_value) . "%</span>";
        return $progress_markup;
    }

    public static function isUserRole($user_role)
    {
        $res_des = Auth::user()->designation;

        $accept = false;
        if ($res_des == $user_role) {
            $accept = true;
        }
        return $accept;

    }

    public static function getProjectIdNameArray()
    {
        $results = DB::table("projects")->get();
        $id_project_name_array = array();
        foreach ($results as $res) {
            $id_project_name_array[$res->default.$res->ProjectID] = $res->ProjectName;
        }
        return $id_project_name_array;
    }


}

?>
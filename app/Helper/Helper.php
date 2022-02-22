<?php 

namespace App\Helper;
use Nepali_Calendar;

class Helper{
	function slug_converter($string){
        $str = strtolower($string);
        $split = explode(' ',$str);
        $slug = implode('-',$split);
        return $slug;
    }

	function date_np_con(){
		$created_at_1 = date("Y-m-d");
		$date = explode('-', $created_at_1);
		$current_y = $date[0];
		$current_m = $date[1];
		$current_d = $date[2];
			include_once(app_path("/includes/nepali_calendare.php"));
        	$calendar = new Nepali_Calendar();
        	$cal = $calendar->eng_to_nep($current_y, $current_m, $current_d);
            if(strlen($cal['month']) == '1'){
              $cal['month'] = '0'.$cal['month']; 
            }
            if(strlen($cal['date']) == '1'){
              $cal['date'] = '0'.$cal['date']; 
            }
        	$nepali_conversion = $cal['year'] . '-' . $cal['month'] . '-' . $cal['date'];
			return $nepali_conversion;
	}

	function date_np_con_year(){
		$created_at_1 = date("Y-m-d");
		$date = explode('-', $created_at_1);
		$current_y = $date[0];
		$current_m = $date[1];
		$current_d = $date[2];
			include_once(app_path("/includes/nepali_calendare.php"));
        	$calendar = new Nepali_Calendar();
        	$cal = $calendar->eng_to_nep($current_y, $current_m, $current_d);
            if(strlen($cal['month']) == '1'){
              $cal['month'] = '0'.$cal['month']; 
            }
            if(strlen($cal['date']) == '1'){
              $cal['date'] = '0'.$cal['date']; 
            }
        	$nepali_conversion = $cal['year'];
			return $nepali_conversion;
	}

	function date_en_con($nepali_date){
		$date = explode('-', $nepali_date);
		// var_dump($date); die();
		$current_y = $date[0];
		$current_m = $date[1];
		$current_d = $date[2];
			include_once(app_path("/includes/nepali_calendare.php"));
			$calendar = new Nepali_Calendar();
			$cal = $calendar->nep_to_eng($current_y, $current_m, $current_d);
			if(strlen($cal['month']) == '1'){
				$cal['month'] = '0' .$cal['month'];
			}
			if(strlen($cal['date']) == '1'){
				$cal['date'] = '0' .$cal['date'];
			}
			$eng_conversion = $cal['year'] . '-' . $cal['month'] . '-' . $cal['date'];
			return $eng_conversion;
	}

	function date_np_con_parm($date){
		$created_at_1 = $date;
		$date = explode('-', $created_at_1);
		$current_y = $date[0];
		$current_m = $date[1];
		$current_d = $date[2];
		include_once(app_path("/includes/nepali_calendare.php"));
		$calendar = new Nepali_Calendar();
		$cal = $calendar->eng_to_nep($current_y, $current_m, $current_d);
		if(strlen($cal['month']) == '1'){
			$cal['month'] = '0'.$cal['month']; 
		}
		if(strlen($cal['date']) == '1'){
			$cal['date'] = '0'.$cal['date']; 
		}
		$nepali_conversion = $cal['year'] . '-' . $cal['month'] . '-' . $cal['date'];
		return $nepali_conversion;
	}
}
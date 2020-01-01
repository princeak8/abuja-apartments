<?php 


if (!function_exists('check_string_length')) {
    function check_string_length($string, $estate=false) {
        if ($estate) {
            $stringLength = 20;
        } else {
            $stringLength = 35;
        }
        $str = strlen($string);
        if ($str >= $stringLength) {
            $substring = substr($string,0,$stringLength);
            $space = strrpos($substring,' ');
            return substr($string,0,$space)." <strong> ...</strong>";
        } else {
            return $string;
        }
    }
    
}

if (!function_exists('shorten_location_name')) { 
    function shorten_location_name($string, $location=false) {
        if ($location) {
            $stringLength = 7;
        } else {
            $stringLength = 17;
        }
        $str = strlen($string);
        if ($str >= $stringLength) {
            $substring = substr($string, 0, $stringLength);
            // return $substring.' ..';
            $space = strrpos($substring, ' ');
            return substr($string, 0, $space) . " ..";
        } else {
            return $string;
        }
    }
}

?>
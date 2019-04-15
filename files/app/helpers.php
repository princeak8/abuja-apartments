<?php 

dd('got here');
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

?>
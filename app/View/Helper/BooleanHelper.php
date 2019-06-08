<?php

class BooleanHelper extends AppHelper {
    function showIcon($value) {
	$fname = ($value)?'true':'false';
        return '<img src="/img/'.$fname.'.png" alt="'.$fname.'">';
    }
}

?>

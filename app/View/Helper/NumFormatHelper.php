<?php

class NumFormatHelper extends AppHelper {
    var $helpers = array('Number');

    function specialDecimal($value) {
      $places = ($value - intval($value) == 0)?0:2;
      return $this->Number->format($value, array(
        'places' => $places,
        'before' => null,
        'escape' => false,
        //'decimals' => ',',
        //'thousands' => '.'
	));
    }
}

?>

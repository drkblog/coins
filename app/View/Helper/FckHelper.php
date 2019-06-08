<?php

class FckHelper extends Helper { 

  var $helpers = Array('Html', 'Js'); 

  function ckedit($id, $content, $options = array())
  {
    $parts = explode('.',$id);
    $parts[0] = ucfirst($parts[0]);
    $id = $parts[0].ucfirst($parts[1]);
    $code = $this->Html->scriptBlock("CKEDITOR.replace('$id');");
    if (array_key_exists('label', $options)) {
      $textarea = "<label for=\"$id\">".$options['label']."</label>";
    }
    $textarea .= "<textarea id=\"".$id."\"
      rows=\"6\" cols=\"30\" name=\"data[".$parts[0]."][".$parts[1]."]\">
      ".$content."</textarea>";
    return "<div class=\"input text\">".$textarea.$code.'</div>'; 
  }
}

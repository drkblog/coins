<?php

class CoinHelper extends AppHelper {
  var $helpers = array('Number');
  
  /**
   * Devuelve cadena con el nombre de una moneda
   */
  function getCoinName($coin) {
    $value = (($coin['Type']['value']-floor($coin['Type']['value'])) != 0.00)?$coin['Type']['value']:floor($coin['Type']['value']);
    return $value.' '.(($coin['Type']['value'] == 1.00)?$coin['Type']['Denomination']['name']:Inflector::pluralize($coin['Type']['Denomination']['name'])).' '.$coin['Coin']['year'].' '.$coin['Coin']['mint_mark'];
  }

  /**
   * Devuelve cadena con el nombre de un tipo de moneda,
   * a partir de una moneda
   */
  function getCoinTypeName($coin) {
    $value = (($coin['Type']['value']-floor($coin['Type']['value'])) != 0.00)?$coin['Type']['value']:floor($coin['Type']['value']);
    $denomination = ($coin['Type']['value'] == 1.00)?$coin['Type']['Denomination']['name']:Inflector::pluralize($coin['Type']['Denomination']['name']);
    $end_year = ($coin['Type']['end_year'])?$coin['Type']['end_year']:'....';
    return $value.' '.$denomination.' ['.$coin['Type']['start_year'].'-'.$end_year.'] '.$coin['Type']['mint_mark'].' '.$coin['Type']['Country']['name'];
  }

  /**
   * Crea path apropiado para imagen subida
   */
  function getImagePath($alias, $data, $thumb = false) {
    if (AuthComponent::user('group_id') == GRP_VIEWER)
      return Router::url(array('controller' => 'coins', 'action' => 'coin_image', $data[$alias]['id'], $thumb));
    else
      return (!empty($data[$alias]['image']))?'/files/'.strtolower($alias).'/'.$data[$alias]['id'].(($thumb)?'/thumb_':'/').$data[$alias]['image']:'/img/none.png';
  }
}

?>

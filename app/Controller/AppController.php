<?php
App::uses('Controller', 'Controller');

define('GRP_ADMIN', 1);
define('GRP_COLLECTOR', 2);
define('GRP_VIEWER', 3);

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
  
  var $components = array('Acl', 'Session', 'RequestHandler',
    'DebugKit.Toolbar',
    'Auth' => array(
      'authenticate' => array(
        'Form' => array(
          'passwordHasher' => array(
            'className' => 'Simple',
            'hashType' => 'sha1'
          ),
          'loginRedirect' => array('controller' => 'coins', 'action' => 'index'),
          'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
        )
      ),
      'authorize' => array('Controller')
    )
  );
  
  var $helpers = array('Html', 'Form', 'Session');
  
  public function beforeFilter() {

    $this->Auth->allow('login', 'logout');

    $this->set('is_admin', ($this->Auth->user('group_id') == GRP_ADMIN));
    $this->set('show_value', ($this->Auth->user('group_id') != GRP_VIEWER));
    
    parent::beforeFilter();
  }
  
  function beforeRender()
  {
    if ($this->RequestHandler->isMobile()) {
      $this->theme = "Mobile";
    }
  }
  
  public function isAuthorized($user = null) {

    // Admin can access every action
    if ($this->Auth->user('group_id') == GRP_ADMIN) { // Administrator
        return true;
    }
    
    if ($this->Auth->user('group_id') == GRP_COLLECTOR) { // Collector
        return in_array($this->request->params['action'], array('index', 'view'));
    }

    if ($this->Auth->user('group_id') == GRP_VIEWER) { // Viewer
        return (bool)(
          in_array($this->request->params['controller'], array('coins', 'types', 'grades', 'denominations', 'emissions', 'countries'))
          &&
          in_array($this->request->params['action'], array('index', 'view', 'coin_image'))
        );
    }

    // Default deny
    return false;
  }
  
  public static function rmdirAndFiles($dir) { 
    $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? self::rmdirAndFiles("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
  }
  
  public static function removeLocalPathToImage($model, $id) {
    AppController::rmdirAndFiles(WWW_ROOT.'files'.DS.strtolower($model->alias).DS.$id);
  }
  public static function localPathToImage($model, $data, $thumb = false) {
    return WWW_ROOT.'files'.DS.strtolower($model->alias).DS.$data[$model->alias]['id'].DS.(($thumb)?'thumb_':'').$data[$model->alias]['image'];
  }
  public static function externalPathToImage($model, $data, $thumb = false) {
    return '/files/'.strtolower($model->alias).'/'.$data[$model->alias]['id'].'/'.(($thumb)?'thumb_':'').$data[$model->alias]['image'];
  }
}

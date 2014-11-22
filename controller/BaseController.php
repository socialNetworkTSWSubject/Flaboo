<?php
//file: controller/BaseController.php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/User.php");
/**
 * Class BaseController
 *
 * Implements a basic super constructor for
 * the controllers in the Blog App.
 * Basically, it provides some protected
 * attributes and view variables.
 * 
 * @author lipido <lipido@gmail.com>
 */
class BaseController {
  /**
   * The view manager instance
   * @var ViewManager
   */
  protected $view;
  
  /**
   * The current user instance
   * @var User
   */
  protected $currentUser;
  
  public function __construct() {
    
    $this->view = ViewManager::getInstance();
    // get the current user and put it to the view
    if (session_status() == PHP_SESSION_NONE) {      
		session_start();
    }
    
    if(isset($_SESSION["currentuser"])) {
     
	  //En la sesion de currentuser se encuentra todo el usuario 
	  //ya que al hacer el login se introdujo todo el usuario en la sesion
      $this->currentUser = new User($_SESSION["currentuser"]);   
	  
      //Que se guarda en currentusername? el email o todo el usuario? si solo es el email xke funciona el dafeult?????????????
      $this->view->setVariable("currentusername", $this->currentUser->getEmail());
	  
    }     
  }
}
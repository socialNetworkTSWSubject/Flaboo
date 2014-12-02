<?php
//file: controller/BaseController.php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/User.php");
/**
 * Class BaseController
 *
 * Clase que implementa un Super Constructor básico del que heredan
 * todos los constructores de la aplicacion
 * 
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */
class BaseController {
  /**
   *Instancia de ViewManager
   * @var ViewManager
   */
  protected $view;
  
  /**
   * Instancia del usuario actual
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
      $this->currentUser = $_SESSION["currentuser"];   
	  
      $this->view->setVariable("currentusername", $this->currentUser);
	  
    }     
  }
}
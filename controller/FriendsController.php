<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../database/UserDAO.php");
require_once(__DIR__."/../controller/BaseController.php");
/**
 * Class UsersController
 * 
 * Controller to login, logout and user registration
 * 
 * @author lipido <lipido@gmail.com>
 */
class FriendsController extends BaseController {
  
  /**
   * Reference to the UserDAO to interact
   * with the database
   * 
   * @var UserMapper
   */  
  private $userDAO;    
  
  public function __construct() {    
    parent::__construct();
    
    $this->userDAO = new UserDAO(); //FriendDAO??
    // Users controller operates in a "welcome" layout
    // different to the "default" layout where the internal
    // menu is displayed
    //   
  }
 
  public function amigos() { 
    $this->view->render("friends", "amigos");    
   
  }
  
   public function buscaramigos() { 
    $this->view->render("friends", "buscaramigos");    
   
  }
  
   public function solicitudes() { 
    $this->view->render("friends", "solicitudes");    
   
  }
  
}
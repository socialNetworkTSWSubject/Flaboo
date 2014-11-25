<?php
require_once(__DIR__."/../database/FriendDAO.php");
require_once(__DIR__."/../model/Friend.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../database/UserDAO.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
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
  private $friendDAO;    
  
  public function __construct() {    
    parent::__construct();
    
    $this->friendDAO = new FriendDAO(); 
    // Users controller operates in a "welcome" layout
    // different to the "default" layout where the internal
    // menu is displayed
    //   
  }
  
   public function aceptarAmistad() { //TERMINADO
   
		$currentuser = $_SESSION["currentuser"];
		
		if (isset($_GET["id"])){

			$friendEmail=$_GET["id"];
			
			$friendship = $this->friendDAO->findPeticion($currentuser, $friendEmail);
			
			if ($friendship == NULL) {
			  throw new Exception("no hay ninguna relacion entre esos usuarios: ");
			}
			
			// find the Post object in the database
			$this->friendDAO->updateIsFriend($friendship);
			//redirige al metodo solicitudes del controlador friends
			$this->view->redirect("friends", "solicitudes");
			 
		}
		//cambia el titulo de la pagina por ---login---
		$this->view->setVariable("title", "---- solicitudes----");
		
		// render the view (/view/users/login.php)
		$this->view->render("friends", "solicitudes");   
   
   }
  
   public function rechazarAmistad() { //TERMINADO
	
		$currentuser = $_SESSION["currentuser"];
		
		if (isset($_GET["id"])){

			$friendEmail=$_GET["id"];
			
			$friendship = $this->friendDAO->findPeticion($currentuser, $friendEmail);
			
			if ($friendship == NULL) {
			  throw new Exception("no hay ninguna relacion entre esos usuarios: ");
			}
			
			// find the Post object in the database
			$this->friendDAO->deleteFriendship($friendship);
			//redirige al metodo solicitudes del controlador friends
			$this->view->redirect("friends", "solicitudes");
			 
		}
		//cambia el titulo de la pagina por ---login---
		$this->view->setVariable("title", "---- solicitudes----");
		
		// render the view (/view/users/login.php)
		$this->view->render("friends", "solicitudes");  
   
   }
   
   
    public function solicitarAmistad() { //TERMINADO
	
		$currentuser = $_SESSION["currentuser"];
		
		if (isset($_GET["id"])){

			$friendEmail=$_GET["id"];
			
			$this->friendDAO->saveFriedship($currentuser, $friendEmail);
			
			//redirige al metodo solicitudes del controlador friends
			$this->view->redirect("friends", "buscaramigos");
			 
		}
		//cambia el titulo de la pagina por ---login---
		$this->view->setVariable("title", "---- Buscar Amigos----");
		
		// render the view (/view/users/login.php)
		$this->view->render("friends", "buscaramigos");  
   
   }
   
   
   public function eliminarAmigo(){
   
		$currentuser = $_SESSION["currentuser"];
		
		if (isset($_GET["id"])){

			$friendEmail=$_GET["id"];
			
			$friendship = $this->friendDAO->findFriendship($currentuser, $friendEmail);
			
			//print_r($friendship);die();
			
			if ($friendship == NULL and $friendship2 == NULL) {
			  throw new Exception("no hay ninguna relacion entre esos usuarios: ");
			}
			if (!$friendship == NULL) {
			  $this->friendDAO->deleteFriendship($friendship);
			}
			
			// find the Post object in the database
			
			//redirige al metodo solicitudes del controlador friends
			$this->view->redirect("friends", "amigos");
			 
		}
		//cambia el titulo de la pagina por ---login---
		$this->view->setVariable("title", "---- amigos----");
		
		// render the view (/view/users/login.php)
		$this->view->render("friends", "amigos");  
   }
  
 
  public function amigos() { //TERMINADO
  
    $currentuser = $_SESSION["currentuser"];
    
    // find the Post object in the database
    $friends = $this->friendDAO->findFriends($currentuser);
    
    if ($friends == NULL) {
      throw new Exception("No se encontro ningun amigo de: ".$currentuser->getName());
    }
    
    // put the Post object to the view
    $this->view->setVariable("friends", $friends);
  
    $this->view->render("friends", "amigos");    
   
  }
  
  
  
   public function buscaramigos() { //TERMINADO
   
		$currentuser = $_SESSION["currentuser"];
		
		// find the Post object in the database
		$busquedas = $this->friendDAO->findUsuarios($currentuser);
		
		if ($busquedas == NULL) {
		  throw new Exception("No hay usuarios");
		}
		
		// put the Post object to the view
		$this->view->setVariable("busquedas", $busquedas);
	   
		$this->view->render("friends", "buscaramigos");    
   
  }
  
   public function solicitudes() { //TERMINADO
   
		$currentuser = $_SESSION["currentuser"];
		
		// find the Post object in the database
		$solicitudes = $this->friendDAO->findSolicitudes($currentuser);
		
		if ($solicitudes == NULL) {
		  throw new Exception("No hay solicitudes para: ".$currentuser->getName());
		}
		
		// put the Post object to the view
		$this->view->setVariable("solicitudes", $solicitudes);
   
   
		$this->view->render("friends", "solicitudes");    
   
  }
  
}
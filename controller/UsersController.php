<?php
require_once(__DIR__."/../database/UserDAO.php");
require_once(__DIR__."/../model/User.php");
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
class UsersController extends BaseController {
  
  /**
   * Reference to the UserDAO to interact
   * with the database
   * 
   * @var UserMapper
   */  
  private $userDAO;    
  
  public function __construct() {    
    parent::__construct();
    
    $this->userDAO = new UserDAO();
    // Users controller operates in a "welcome" layout
    // different to the "default" layout where the internal
    // menu is displayed
    //   
  }
 /**
   * Action to login
   * 
   * Logins a user checking its creedentials agains
   * the database   
   * 
   * When called via GET, it shows the login form
   * When called via POST, it tries to login
   * 
   * The expected HTTP parameters are:
   * <ul>
   * <li>login: The username (via HTTP POST)</li>
   * <li>passwd: The password (via HTTP POST)</li>      
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>posts/login: If this action is reached via HTTP GET (via include)</li>
   * <li>posts/index: If login succeds (via redirect)</li>   
   * <li>users/login: If validation fails (via include). Includes these view variables:</li>
   * <ul>   
   *  <li>errors: Array including validation errors</li>   
   * </ul>   
   * </ul>
   * 
   * @return void
   */
  public function login() {
    if (isset($_POST["email"])){ // reaching via HTTP Post...
      //process login form    
      if ($this->userDAO->isValidUser($_POST["email"], $_POST["password"])) {
		
		$user = $this->userDAO->findByEmail($_POST["email"]);
		$_SESSION["currentuser"]=$user;
		
		// Envia al usuario al metodo posts del PostsController. (aora lo ke hace ese metodo es mandar al usuario a inicio.php/ adri lo tiene que cambiar)
		$this->view->redirect("posts", "posts");
	
      }else{
		$errors = array();
		$errors["emaillogin"] = "El email no es válido";
		$this->view->setVariable("errors", $errors);
      }
    }   
	//cambia el titulo de la pagina por ---login---
	$this->view->setVariable("title", "---- login----");
	// layouts welcome.php
    $this->view->setLayout("welcome");  
    // render the view (/view/users/login.php)
    $this->view->render("users", "login"); 
  }
  
  
  
 /**
   * Action to register
   * 
   * When called via GET, it shows the register form.
   * When called via POST, it tries to add the user
   * to the database.
   * 
   * The expected HTTP parameters are:
   * <ul>
   * <li>login: The username (via HTTP POST)</li>
   * <li>passwd: The password (via HTTP POST)</li>      
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>users/register: If this action is reached via HTTP GET (via include)</li>
   * <li>users/login: If login succeds (via redirect)</li>
   * <li>users/register: If validation fails (via include). Includes these view variables:</li>
   * <ul>   
   *  <li>user: The current User instance, empty or being added
   *  (but not validated)</li>      
   *  <li>errors: Array including validation errors</li>   
   * </ul>   
   * </ul>
   * 
   * @return void
   */
  public function register() {
    
    $user = new User();
    
    if (isset($_POST["email"])){ // reaching via HTTP Post...
      
      // populate the User object with data form the form
      $user->setEmail($_POST["email"]);
      $user->setPassword($_POST["password"]);
	  $user->setName($_POST["name"]);
      
      try{
		$user->checkIsValidForRegister($_POST["repeat_password"]); // if it fails, ValidationException
	
	// check if user exists in the database
	if (!$this->userDAO->emailExists($_POST["email"])){
		
		
	  // save the User object into the database
	  $this->userDAO->save($user);
	  
	  // POST-REDIRECT-GET
	  // Everything OK, we will redirect the user to the list of posts
	  // We want to see a message after redirection, so we establish
	  // a "flash" message (which is simply a Session variable) to be
	  // get in the view after redirection.
	  $this->view->setFlash("Email ".$user->getEmail()." añadido. Por favor, logueate ahora");
	  
	  // perform the redirection. More or less: 
	  // header("Location: index.php?controller=users&action=login")
	  // die();
	  $this->view->redirect("users", "login");
	} else {
	  $errors = array();
	  $errors["email"] = "Este email ya existe";
	  $this->view->setVariable("errors", $errors);
	}
      }catch(ValidationException $ex) {
		// Get the errors array inside the exepction...
		$errors = $ex->getErrors();
		// And put it to the view as "errors" variable
		$this->view->setVariable("errors", $errors);
      }
    }
    
	//cambia el titulo de la pagina por ---login---
	$this->view->setVariable("title", "---- login----");
	// Put the User object visible to the view
    $this->view->setVariable("user", $user);
	// layouts welcome.php
    $this->view->setLayout("welcome");  
    // render the view (/view/users/login.php)
    $this->view->render("users", "login"); 
	
  }
 /**
   * Action to logout
   * 
   * This action should be called via GET
   * 
   * No HTTP parameters are needed.
   *
   * The views are:
   * <ul>
   * <li>users/login (via redirect)</li>
   * </ul>
   *
   * @return void
   */
  public function logout() {
    session_destroy();
	
	echo "cerrando sesion de: ";
	echo $_SESSION["currentuser"];
    
    // perform a redirection. More or less: 
    // header("Location: index.php?controller=users&action=login")
    // die();
    $this->view->redirect("users", "login");
   
  }
  
}
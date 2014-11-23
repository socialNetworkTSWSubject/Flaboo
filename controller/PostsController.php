<?php
require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../database/PostDAO.php");
require_once(__DIR__."/../controller/BaseController.php");
/**
 * Class UsersController
 * 
 * Controller to login, logout and user registration
 * 
 * @author lipido <lipido@gmail.com>
 */
class PostsController extends BaseController {
  
  /**
   * Reference to the UserDAO to interact
   * with the database
   * 
   * @var UserMapper
   */  
  private $postDAO;    
  
  public function __construct() {    
    parent::__construct();
    
    $this->postDAO = new PostDAO(); 
  }
  
  public function viewPost() {
  	if (!isset($this->currentUser)) {
  		throw new Exception("Not in session. Editing posts requires login");
  	}

  	$post = $this->postDAO->findByAuthor($this->currentUser->getEmail());
  	
  	if ($post == NULL) {
  		throw new Exception("no such post with id: ".$postid);
  	}
  	
  	$this->view->setVariable("post", $post);
  	$this->view->render("posts","inicio");
  	$this->view->setLayout("default");
	echo "Prueba";
  }
  
  
  public function addPost() {
  	if (!isset($this->currentUser)) {
  		throw new Exception("Not in session. Editing posts requires login");
  	}

  	$post = new Post();
  	
  	if(isset($_POST["submit"])){
  		$post->setContent($_POST["content"]);
  		$post->setDate($_POST["date"]);
  		$post->setAuthor($this->currentUser);
  	}
  	
  	try {
  		//Valide Post Object
  		$post->checkIsValidForCreate();
  		
  		//Guarda el post en la base de datos
  		$post->postDAO->save();
  		
  		// POST-REDIRECT-GET
  		// Everything OK, we will redirect the user to the list of posts
  		// We want to see a message after redirection, so we establish
  		// a "flash" message (which is simply a Session variable) to be
  		// get in the view after redirection.
  		$this->view->setFlash("Post \"".$post->getIdPost()."\" successfully added.");
  		$this->view->redirect("posts", "inicio");
  		
  		
  		
  	} catch(ValidationException $ex){
  		$errors = $ex->getErrors();
  		$this->view->setVariable("errors", $errors);
    }
  	
    $this->view->setVariable("post", $post);
    
    // render the view (/view/posts/add.php)
    $this->view->render("posts", "inicio");
    
  	
  	
  	
  	
  	
  	
  }
  
  /*
 //ADRI DEJA ESTE METODO TAL COMO ESTA PARA QUE PUEDA SEGUIR HACIENDO PRUEBAS CON EL!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  public function posts() { 
  	$this->view->render("posts", "inicio");    
  }
  */
}
<?php
require_once(__DIR__."/../database/PostDAO.php");
require_once(__DIR__."/../database/FriendDAO.php");
require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../controller/BaseController.php");
/**
 * Class UsersController
 * 
 * Controlador relativo a los post cuyas funcionalidades 
 * son mostrar y añadir nuevos post
 * 
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */
class PostsController extends BaseController {
  
  /**
   * Referencia a la clase PostDAO que interactua con la BD
   * @var PostDAO
   */  
  private $postDAO; 
  
  /**
   * Referencia a la clase PostDAO que interactua con la BD
   * @var FriendDAO
   */
  private $friendDAO;
  
  public function __construct() {    
    parent::__construct();
    
    $this->postDAO = new PostDAO();
    $this->friendDAO = New FriendDAO(); 
  }
  
  /**
   * Realiza un listado de todos los post cuyo autor es el usuario
   * o un amigo del usuario.
   * @throws Exception Si el usuario no inicio sesion
   */
  public function viewPosts() {
 
  	if (!isset($this->currentUser)) {
  		throw new Exception("Not in session. Editing posts requires login");
  	}
	
	//Carga los post en la vista y la renderiza
  	$this->view->setVariable("posts", $this->loadPost());
  	$this->view->render("posts","inicio");
  }
  
   /**
   * Inserta un nuevo post en el muro del usuario actual si dicho usuario 
   * inicio sesion previamente.
   * @throws Exception Si no esta en sesion  
   */
  public function addPost() {
  	if (!isset($this->currentUser)) {
  		throw new Exception("Not in session. Editing posts requires login");
  	}

  	$post = new Post();
  	
  	if(isset($_POST["submit"])){
  		$post->setContent($_POST["content"]);
  		$post->setDate(date("Y-m-d H:i:s"));
  		$post->setAuthor($this->currentUser->getEmail());
  	}
  	
  	try {
  		//Valida el objeto Post
  		$post->checkIsValidForCreate();
  		
  		//Guarda el post en la base de datos
  		$this->postDAO->save($post);
		
		//Redirecciona a la accion viewPost del controlador Post
  		$this->view->redirect("posts", "viewPosts");

  	} catch(ValidationException $ex){
  		$errors = $ex->getErrors();
  		$this->view->setVariable("errors", $errors);
    }
  	
	//Carga los post en la vista y la renderiza
    $this->view->setVariable("posts", $this->loadPost());
    $this->view->render("posts", "inicio");	
  }
  
  /**
   * Metodo privado que es llamada por las acciones viewPost() y addPost() del controlador de posts.
   * Carga en memoria los post segun los criterios establecidos en el metodo viewPost().
   *
   * @throws Exception si no encuentra ningun post
   * @return mixed Array de las instancias Post 
   */ 		
  private function loadPost(){
	$posts = $this->postDAO->findByAuthor($this->currentUser);
  	
  	if ($posts == NULL) {
  		throw new Exception("no such posts");
  	}
	return $posts;
  }
  
}
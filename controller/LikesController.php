<?php
//file /controller/LikesController.php

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../model/Like.php");
require_once(__DIR__."/../database/PostDAO.php");
require_once(__DIR__."/../database/LikeDAO.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
 * Class LikesController
 * Controlador relativo a los likes de un post
 * 
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */

class LikesController extends BaseController{
	
	/**
	 * Reference to the LikeDAO to interact with the database
	 * @var likeDAO
	 */
	private $likeDAO;
	
	/**
	 * Reference to the PostDAO to interact with de database
	 * @var postDAO 
	 */
	private $postDAO;
	
	public function __construct(){
		parent::__construct();
		
		$this->likeDAO = new LikeDAO;
		$this->postDAO = new PostDAO();
	}
	
	public function addLike(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing posts requires login");
		}
		
		if (isset($_POST["id"])) { // reaching via HTTP Post...
		
			// Get the Post object from the database
			$postid = $_POST["id"];
			$post = $this->postDAO->findByIdPost($postid);
			
			if ($post == NULL) {
				throw new Exception("no such post with id: ".$postid);
			}
			
			//Create the Like Object
			$like = new Like($this->currentUser->getEmail(),$post);
			
			try {
				$this->likeDAO->addLike($like);
				$this->view->redirect("posts", "viewPost", "id=".$post->getIdPost());
			} catch (ValidationException $ex){
				$errors = $ex->getErrors();
			
				$this->view->setVariable("like", $like, true);
				$this->view->setVariable("errors", $errors, true);
					
				$this->view->redirect("posts", "viewPost", "id=".$post->getIdPost());
			}
		} else {
			throw new Exception("No such post id");
		}

	}
	
}
?>
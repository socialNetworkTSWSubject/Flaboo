<?php
//file models/Post.php

require_once(__DIR__."/../core/ValidationException.php");


/**
 * Class Post
 * 
 * Representa a los post que los usuarios crearan en la red social
 * 
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */

class Post 
{
	/**
	 * id del post
	 * @var int
	 */
	private $idPost;
	
	/**
	 * fecha y hora en la que se creo el post
	 * @var string
	 */
	private $date;
	
	/**
	 * contenido del post
	 * @var string
	 */
	private $content;
	
	/**
	 * numero de likes que tiene el post
	 * @var int
	 */
	private $numLikes;

	/**
	 * autor del post
	 * @var string
	 */
	private $author;
	
	/**
	 * likes del post
	 * @var mixed
	 */
	private $likes;
	
	/**
	 * comentarios del post
	 * @var mixed
	 */
	private $comments = array();
	
	/**
	 * Constructor del post
	 * @param int $idPost El id del post
	 * @param string $date La fecha y hora de creacion del post
	 * @param string $content El contenido del post
	 * @param int $numLikes El numero de likes del post
	 * @param string $author El autor del post
	 * @param mixed $likes Los likes del post
	 * @param mixed $comments Los comentarios del post
	 */
	public function __construct($idPost=NULL, $date=NULL, $content=NULL, $numLikes=NULL, $author=NULL, $likes=NULL, $comments=array()){
		$this->idPost = $idPost;
		$this->date = $date;
		$this->content = $content;
		$this->numLikes = $numLikes;
		$this->author = $author;
		$this->likes = $likes;
		$this->comments = $comments;
	}
	
	/**
	 * Devuelve el id del post
	 * @return int El id del post
	 */
	public function getIdPost(){
		return $this->idPost;
	}
	
	/**
	 * Devuelve la fecha y hora de creacion del post
	 * @return string La fecha y la hora
	 */
	public function getDate(){
		return $this->date;
	}
	/**
	 * Modifica la fecha y hora de creacion del post
	 * @param string $date La fecha y hora de creacion del post
	 */	
	public function setDate($date){
		$this->date = $date;
	}
	
	/**
	 * Devuelve el contenido del post
	 * @return string El contenido del post
	 */
	public function getContent(){
		return $this->content;
	}
	
	/**
	 * Modifica el contenido del post
	 * @param string $content El contenido del post
	 */	
	public function setContent($content){
		$this->content = $content;
	}
	
	/**
	 * Devuelve el autor del post
	 * @return string El autor del post
	 */
	public function getAuthor(){
		return $this->author;
	}
	
	/**
	 * Modifica el autor del post
	 * @param string El autor del post
	 */
	public function setAuthor($author){
		$this->author = $author;
	}
	
	/**
	 * Devuelve el numero de likes del post
	 * @return int Likes del post
	 */
	public function getNumLikes(){
		return $this->numLikes;
	}
	
	/**
	 * Modifica el numero de likes del post
	 * @param int $numLikes El numero de likes
	 */
	public function setNumLikes($numLikes){
		$this->numLikes = $numLikes;
	}
	
	/**
	 * Enlaza los likes en el post
	 * @param mixed $likes
	 */
	public function setLikes(array $likes){
		$this->likes = $likes;
	}
	
	/**
	 * Devuelve los comentarios del post
	 * @return mixed $comments
	 */
	 public function getComments(){
		return $this->comments;
	 }
	 
	 public function addComment($comment) {
		array_push($this->comments, $comment);
	 }
	/**
	 * Enlaza los comentarios en el post
	 * @param mixed $comments 
	 */
	public function setComments(array $comments){
		$this->comments = $comments;
	}
	
	/**
	 * Comprueba si la instancia del post es valida para ser almacenada
	 * en la base de datos.
	 * @throws ValidationException si la instancia creada no es valida
	 * @return void  
	 */
	
	public function checkIsValidForCreate(){
		$errors = array();
		
		if(strlen($this->content)=='0'){
			$errors["content"] = "content is mandatory";
		}
		if($this->author === NULL){
			$errors["author"] = "author is mandatory";
		}
		if(sizeof($errors) > 0){
			throw new ValidationException($errors, "post is not valid");
		}
	}
	
	
	
	
}

?>
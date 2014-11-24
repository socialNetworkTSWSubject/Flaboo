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
	 * Constructor del post
	 * @param int $idPost El id del post
	 * @param string $date La fecha y hora de creacion del post
	 * @param string $content El contenido del post
	 * @param int $numLikes El numero de likes del post
	 * @param string $author El autor del post
	 * @param mixed $likes Los likes del post
	 */
	public function __construct($idPost=NULL, $date=NULL, $content=NULL, $numLikes=NULL, $author=NULL, $likes=NULL){
		$this->idPost = $idPost;
		$this->date = $date;
		$this->content = $content;
		$this->numLikes = $numLikes;
		$this->author = $author;
		$this->likes = $likes;
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
	 * Devuelve el contenido del post
	 * @return string El contenido del post
	 */
	public function getContent(){
		return $this->content;
	}
	
	/**
	 * Devuelve el autor del post
	 * @return string El autor del post
	 */
	public function getAuthor(){
		return $this->author;
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
	 * @param array $likes
	 */
	public function setLikes(array $likes){
		$this->likes = $likes;
	}
	
	
	/**
	 * Comprueba si la instancia del post es valida para ser almacenada
	 * en la base de datos.
	 * @throws ValidationException si la instancia creada no es valida
	 * @return void  
	 */
	
	public function checkIsValidForCreate(){
		$errors = array();
		if(empty($this->content)){
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
<?php
// file /models/Like.php
	
require_once(__DIR__."/../core/ValidationException.php");

/**
 * Class Like
 *
 * Representa un like en un post
 *
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */

class Like {
	
	/**
	 * email del usuario que hizo like en el post
	 * @var string
	 */
	private $author;
	
	/**
	 * id del POST en el que se hizo like
	 * @var int
	 */
	private $post;
	
	/**
	 * Constructor de la clase Like
	 * @param string $authorLike email del usuario
	 * @param int $likePost id del post
	 */
	public function __construct($author, $post){
		$this->author = $author;
		$this->post = $post;
	}
	
	/**
	 * Devuelve el email del autor del like
	 * @return string email del autor
	 */
	public function getAuthor(){
		return $this->author;
	}
	
	/**
	 * Modifica el email del autor del like
	 * @param string $authorLike El autor del like
	 * @return void
	 */
	public function setAuthor($author){
		$this->author = $author;
	}
	
	/**
	 * Devuelve el id del post del like
	 * @return int id del post
	 */
	public function getPost(){
		return $this->post;
	}
	
	/**
	 * Modifica el id del like del post
	 * @param int $likePost El id del post
	 * @return void
	 */
	public function setPost($post){
		$this->post = $post;
	}
}
?>
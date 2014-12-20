<?php
// file /models/LikeComment.php

require_once(__DIR__."/../core/ValidationException.php");

/**
 * Class LikeComment
 *
 * Representa un like en un comentario
 *
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
*/

class LikeComment {

	/**
	 * email del usuario que hizo like en el comment
	 * @var string
	 */
	private $author;

	/**
	 * id del comment en el que se hizo like
	 * @var int
	 */
	private $comment;

	/**
	 * Constructor de la clase Like
	 * @param string $authorLike email del usuario
	 * @param int $likecomment id del comment
	 */
	public function __construct($author, $comment){
		$this->author = $author;
		$this->comment = $comment;
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
	 * Devuelve el id del comment del like
	 * @return int id del comment
	 */
	public function getComment(){
		return $this->comment;
	}

	/**
	 * Modifica el id del like del comment
	 * @param int $likecomment El id del comment
	 * @return void
	 */
	public function setComment($comment){
		$this->comment = $comment;
	}
}
?>
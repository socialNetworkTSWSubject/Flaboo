<?php
// file /model/Comment.php
require_once (__DIR__ . "/../core/ValidationException.php");

/**
 * Class Comment
 * Representa un comentario relativo a un post de la red social.
 * Un usuario puede realizar un comentario de sus post o de los
 * post de sus amigos. Tambien puede hacer like en un comentario.
 *
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */
class Comment {
	
	/**
	 * El id del comentario
	 * 
	 * @var string
	 */
	private $id;
	
	/**
	 * Fecha y hora en la que se creo el comentario
	 * 
	 * @var string
	 */
	private $date;
	
	/**
	 * El contenido del comentario
	 * 
	 * @var string
	 */
	private $content;
	
	/**
	 * El numero de likes del comentario
	 * 
	 * @var int
	 */
	private $numLikes;
	
	/**
	 * El autor del comentario
	 * 
	 * @var User
	 */
	private $author;
	
	/**
	 * El post relativo a este comentario
	 * 
	 * @var Post
	 */
	private $post;
	
	/**
	 * Likes del comentario
	 * 
	 * @var mixed
	 */
	private $likes;
	
	/**
	 * Constructor de la clase Comment
	 *
	 * @param string $id
	 *        	El id del comentario
	 * @param string $content
	 *        	El contenido del comentario
	 * @param User $author
	 *        	El autor del comentario
	 * @param Post $post
	 *        	El post relativo al comentario
	 */
	public function __construct($id = NULL, $date = NULL, $content = NULL, $numLikes = NULL, $author = NULL, $post = NULL, $likes=NULL) {
		$this->id = $id;
		$this->date = $date;
		$this->content = $content;
		$this->numLikes = $numLikes;
		$this->author = $author;
		$this->post = $post;
		$this->likes = $likes;
	}
	
	/**
	 * Gets the id of this comment
	 *
	 * @return string The id of this comment
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Devuelve la fecha y hora de creacion del post
	 * 
	 * @return string La fecha y la hora
	 */
	public function getDate() {
		return $this->date;
	}
	/**
	 * Modifica la fecha y hora de creacion del post
	 * 
	 * @param string $date
	 *        	La fecha y hora de creacion del post
	 */
	public function setDate($date) {
		$this->date = $date;
	}
	/**
	 * Gets the content of this comment
	 *
	 * @return string The content of this comment
	 */
	public function getContent() {
		return $this->content;
	}
	/**
	 * Sets the content of the Comment
	 *
	 * @param string $content
	 *        	the content of this comment
	 * @return void
	 */
	public function setContent($content) {
		$this->content = $content;
	}
	/**
	 * Devuelve el numero de likes del post
	 * 
	 * @return int Likes del post
	 */
	public function getNumLikes() {
		return $this->numLikes;
	}
	
	/**
	 * Modifica el numero de likes del post
	 * 
	 * @param int $numLikes
	 *        	El numero de likes
	 */
	public function setNumLikes($numLikes) {
		$this->numLikes = $numLikes;
	}
	
	/**
	 * Enlaza los likes en el post
	 * 
	 * @param array $likes        	
	 */
	public function setLikes(array $likes) {
		$this->likes = $likes;
	}
	
	/**
	 * Gets the author of this comment
	 *
	 * @return User The author of this comment
	 */
	public function getAuthor() {
		return $this->author;
	}
	/**
	 * Sets the author of this comment
	 *
	 * @param User $author
	 *        	the author of this comment
	 * @return void
	 */
	public function setAuthor(User $author) {
		$this->author = $author;
	}
	
	/**
	 * Gets the parent post of this comment
	 *
	 * @return Post The parent post of this comment
	 */
	public function getPost() {
		return $this->post;
	}
	/**
	 * Sets the parent Post
	 *
	 * @param Post $post
	 *        	the parent post
	 * @return void
	 */
	public function setPost(Post $post) {
		$this->post = $post;
	}
	
	/**
	 * Checks if the current instance is valid
	 * for being inserted in the database.
	 *
	 * @throws ValidationException if the instance is
	 *         not valid
	 *        
	 * @return void
	 */
	public function checkIsValidForCreate() {
		$errors = array ();
		
		if (strlen ( trim ( $this->content ) ) < 2) {
			$errors ["content"] = "content is mandatory";
		}
		if ($this->author == NULL) {
			$errors ["author"] = "author is mandatory";
		}
		if ($this->post == NULL) {
			$errors ["post"] = "post is mandatory";
		}
		
		if (sizeof ( $errors ) > 0) {
			throw new ValidationException ( $errors, "comment is not valid" );
		}
	}
}
?>
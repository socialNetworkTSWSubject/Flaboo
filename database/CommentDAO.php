<?php
// file: database/CommentDAO.php
require_once (__DIR__ . "/../core/PDOConnection.php");
require_once (__DIR__ . "/../model/Comment.php");

/**
 * Class CommentDAO
 * DAO que encapsula las sentencias SQL necesarias para gestionar los comentarios de la BD
 * Implementa el metodo de almacenar comentarios.
 *
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */
class CommentDAO {
	
	/**
	 * Referencia a la conexión PDO
	 * 
	 * @var PDO
	 */
	private $db;
	public function __construct() {
		$this->db = PDOConnection::getInstance ();
	}
	
	/**
	 * Guarda un comentario en la base de datos
	 *
	 * @param Comment $coment
	 *        	El comentario a ser guardado
	 * @throws PDOException Si ocurre un error de base de datos
	 * @return void
	 */
	public function save(Comment $comment) {
		$stmt = $this->db->prepare ( "INSERT INTO comments(`dateComment`,`content`,`numLikes`,`author`,`idPost`) values(?,?,?,?,?)" );
		$stmt->execute (array($comment->getDate(),$comment->getContent (),0,$comment->getAuthor(),$comment->getIdPost()));
	}
	
	
	public function findByIdComment($idComment){
		$stmt = $this->db->prepare("SELECT * FROM comments WHERE idComment = ?");
		$stmt->execute (array($idComment));
		$comment = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if(sizeof($comment) > 0){
			return new Comment($comment["idComment"],$comment["dateComment"],$comment["content"],$comment["numLikes"],
					$comment["author"],$comment["idPost"]);
		} else return NULL;	
	}
}
?>
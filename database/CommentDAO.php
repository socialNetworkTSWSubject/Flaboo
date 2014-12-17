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
		$stmt = $this->db->prepare ( "INSERT INTO comment(`dateComment`,`content`,`numLikes`,`author`,`idPost`) values(?,?,?,?,?)" );
		$stmt->execute ( array (
				$comment->getDate (),
				$comment->getContent (),
				$comment->getNumLikes (),
				$comment->getAuthor (),
				$comment->getIdPost () 
		) );
	}
}
?>
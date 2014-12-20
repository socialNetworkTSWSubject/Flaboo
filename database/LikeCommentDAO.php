<?php
// file: database/LikeCommentDAO.php
require_once(__DIR__."/../core/PDOConnection.php");
/**
 * Class LikeDAO
 *
 * DAO que encapsula las sentencias SQL necesarias para gestionar los likes de la BD
 * Implementa los metodos de almacenar un like, comprobar si un usuario concreto hizo
 * like en un Comment e incrementar el numero de likes en Comment dado
 *
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
*/

class LikeCommentDAO {

	/**
	 * Referencia a la conexion PDO
	 * @var PDO
	 */
	private $db;

	public function __construct(){
		$this->db = PDOConnection::getInstance();
	}

	/**
	 * Incrementa un like en el Comment
	 * @param Like $like
	 * @throws PDOException si ocurre algun error en la BD
	 */
	public function addLikeComment(LikeComment $like){
		$stmt = $this->db->prepare("INSERT INTO likescomments(authorLike,likeComment) values(?,?)");
		$stmt->execute(array($like->getAuthor(),$like->getComment()->getId()));
	}

	/**
	 * Decrementa un like en el Comment
	 * @param Like $like
	 * @throws PDOException si ocurre algun error en la BD
	 */
	public function removeLikeComment(LikeComment $like){
		$stmt = $this->db->prepare("DELETE FROM likescomments WHERE authorLike=? and likeComment=?");
		$stmt->execute(array($like->getAuthor(),$like->getComment()->getId()));
	}

	/**
	 * Comprueba si el usuario actual hizo like en ese Comment
	 * @var User $user El objecto usuario actual
	 * @var int $idComment El id del Comment
	 * @throws PDOException si ocurre algun error en la BD
	 * @return int El numero de likes de ese Comment hechos por ese usuario
	 */
	public function isNewLike(User $user, $idComment){
		$stmt = $this->db->prepare("SELECT * FROM likescomments WHERE authorLike = ? and likeComment = ?");
		$stmt->execute(array($user->getEmail(),$idComment));
		return $stmt->rowCount();
	}

	/**
	 * Incrementa el numero de likes de un Comment
	 * @param $idComment El id del Comment
	 * @throws PDOException si ocurre algun error en la BD
	 */
	public function increaseNumLikes($idComment){
		$stmt = $this->db->prepare("UPDATE comments SET numLikes = numLikes+1 WHERE idComment = ?");
		$stmt->execute(array($idComment));
	}

	/**
	 * Decrementa el numero de likes de un Comment
	 * @param $idComment El id del Comment
	 * @throws PDOException si ocurre algun error en la BD
	 */
	public function decreaseNumLikes($idComment){
		$stmt = $this->db->prepare("UPDATE comments SET numLikes = numLikes-1 WHERE idComment = ?");
		$stmt->execute(array($idComment));
	}

}
?>
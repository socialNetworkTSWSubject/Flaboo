<?php

// file: database/LikeDAO.php
require_once(__DIR__."/../core/PDOConnection.php");
/**
 * Class LikeDAO
 *
 * Database interface for Post entities
 *
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
*/

class LikeDAO {
	
	/**
	 * Referencia a la conexión PDO
	 * @var PDO
	 */
	private $db;
	
	public function __construct(){
		$this->db = PDOConnection::getInstance();
	}
	
	/**
	 * Incrementa un like en el post
	 * @param Like $like
	 */
	public function addLikePost(Like $like){
		$stmt = $this->db->prepare("INSERT INTO likes(authorLike,likePost) values(?,?)");
		$stmt->execute(array($like->getAuthor(),$like->getPost()->getIdPost()));
	}
	
	/**
	 * Cuenta el numero de likes del post 
	 * @param int $idPost El id del post
	 * @return int like El numero de likes del post
	 */
	public function countLikes($idPost){
		$stmt = $this->db->prepare("SELECT count (*) FROM likes WHERE likePost = ?");
		$stmt->execute(array($idPost));
		return $stmt->rowCount();
	}
	
	/**
	 * Comprueba si el usuario actual hizo like en ese post
	 * @var User $user El objecto usuario actual
	 * @var int $idPost El id del post
	 * @return El numero de likes de ese post hechos por ese usuario
	 */
	public function isNewLike(User $user, $idPost){
		$stmt = $this->db->prepare("SELECT * FROM likes WHERE authorLike = ? and likePost = ?");
		$stmt->execute(array($user->getEmail(),$idPost));
		return $stmt->rowCount();
	}
	
	/**
	 * Incrementa el numero de likes de un post
	 * @var idPost El id del post
	 */
	public function increaseNumLikes($idPost){
		$stmt = $this->db->prepare("UPDATE post SET numLikes = numLikes+1 WHERE idPost = ?");
		$stmt->execute(array($idPost));
	}
	
}
?>
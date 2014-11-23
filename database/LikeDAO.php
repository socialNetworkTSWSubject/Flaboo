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
	public function addLikePost($like){
		$stmt = $this->db->prepare("INSER INTO likes(authorLike,likePost) values(?,?)");
		$stmt->execute(array($like->getAuthorLike(),$like->getlikePost()));
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
}
?>
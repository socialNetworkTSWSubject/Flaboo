<?php

// file: database/LikeDAO.php
require_once(__DIR__."/../core/PDOConnection.php");
/**
 * Class LikeDAO
 *
 * DAO que encapsula las sentencias SQL necesarias para gestionar los likes de la BD
 * Implementa los metodos de almacenar un like, comprobar si un usuario concreto hizo
 * like en un post e incrementar el numero de likes en post dado 
 *
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
*/

class LikeDAO {
	
	/**
	 * Referencia a la conexion PDO
	 * @var PDO
	 */
	private $db;
	
	public function __construct(){
		$this->db = PDOConnection::getInstance();
	}
	
	/**
	 * Incrementa un like en el post
	 * @param Like $like
	 * @throws PDOException si ocurre algun error en la BD
	 */
	public function addLikePost(Like $like){
		$stmt = $this->db->prepare("INSERT INTO likes(authorLike,likePost) values(?,?)");
		$stmt->execute(array($like->getAuthor(),$like->getPost()->getIdPost()));
	}
	
	/**
	 * Decrementa un like en el post
	 * @param Like $like
	 * @throws PDOException si ocurre algun error en la BD
	 */
	public function removeLikePost(Like $like){
		$stmt = $this->db->prepare("DELETE FROM likes WHERE authorLike=? and likePost=?");
		$stmt->execute(array($like->getAuthor(),$like->getPost()->getIdPost()));
	}
	
	/**
	 * Comprueba si el usuario actual hizo like en ese post
	 * @var User $user El objecto usuario actual
	 * @var int $idPost El id del post
	 * @throws PDOException si ocurre algun error en la BD
	 * @return int El numero de likes de ese post hechos por ese usuario
	 */
	public function isNewLike(User $user, $idPost){
		$stmt = $this->db->prepare("SELECT * FROM likes WHERE authorLike = ? and likePost = ?");
		$stmt->execute(array($user->getEmail(),$idPost));
		return $stmt->rowCount();
	}
	
	/**
	 * Incrementa el numero de likes de un post
	 * @param $idPost El id del post
	 * @throws PDOException si ocurre algun error en la BD
	 */
	public function increaseNumLikes($idPost){
		$stmt = $this->db->prepare("UPDATE post SET numLikes = numLikes+1 WHERE idPost = ?");
		$stmt->execute(array($idPost));
	}
	
	/**
	 * Decrementa el numero de likes de un post
	 * @param $idPost El id del post
	 * @throws PDOException si ocurre algun error en la BD
	 */
	public function decreaseNumLikes($idPost){
		$stmt = $this->db->prepare("UPDATE post SET numLikes = numLikes-1 WHERE idPost = ?");
		$stmt->execute(array($idPost));
	}
	
}
?>
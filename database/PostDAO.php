<?php
// file: database/PostDAO.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
 * Class UserDAO
 *
 * Database interface for Post entities
 *
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */

class PostDAO {
	
	/**
	 * Referencia a la conexión PDO
	 * @var PDO
	 */
	private $db;
	
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}
	
	/**
	 * Guarda un post en la base de datos
	 *
	 * @param Post $post El post a ser guardado
	 * @throws PDOException Si ocurre un error de base de datos
	 * @return void
	 */
	public function save($post){
		$stmt = $this->db->prepare("INSERT INTO post (datePost,content,numLikes,author) values(?,?,?)");
		$stmt->execute(array($post->getDate(), $post->getContent(), $post->getNumLikes(), $post->getAuthor()));
	}
	
	/**
	 * Carga todos los post relativos al usuario actual
	 * @param string $author El id del usuario actual
	 * @return Post Las instancias de Post, NULL en caso de no encontrar los post 
	 */
	public function findByIdUser($author){
		$stmt = $this->db->prepare("SELECT idPost,datePost,content,numLikes,author FROM POST WHERE 
		author = some(SELECT friendEmail FROM FRIENDS WHERE userEmail = ? && isFriend = 1) ORDER BY datePost");
		$stmt->execute(array($author));
		$post = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if($post>0){
			$post = new Post($post[0]["idPost"], $post[0]["datePost"], $post[0]["content"], 
					$post[0]["numLikes"], $post[0]["author"]);	
			return $post;
		} else return null;
	}
	
	
	
}










?>
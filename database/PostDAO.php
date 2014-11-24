<?php
// file: database/PostDAO.php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../model/Like.php");
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
	
	
	
// 	/**
// 	 * Carga todos los post relativos al usuario actual
// 	 * @param string $author El id del usuario actual
// 	 * @return Post Las instancias de Post, NULL en caso de no encontrar los post 
// 	 */
// 	public function findByIdUser($author){
// 		$stmt = $this->db->prepare("SELECT idPost,datePost,content,numLikes,author FROM POST WHERE 
// 		author = some(SELECT friendEmail FROM FRIENDS WHERE userEmail = ? && isFriend = 1) ORDER BY datePost");
// 		$stmt->execute(array($author));
// 		$post = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 		if($post>0){
// 			$post = new Post($post[0]["idPost"], $post[0]["datePost"], $post[0]["content"], 
// 					$post[0]["numLikes"], $post[0]["author"]);	
// 			$likes = array();
// 			return $post;
// 		} else return null;
// 	}
	
	/**
	 * Carga todos los post con sus likes segun el id
	 * @param string $idPost
	 * @return Post Las instancias de post|NULL en caso de no existir post 
	 */
	public function findByIdPost($idPost){
		$stmt = $this->db->prepare("SELECT 
				P.idPost as 'post.id',
				P.datePost as 'post.date',
				P.content as 'post.content',
				P.numLikes as 'post.numLikes',
				P.author as 'post.author',
				L.authorLike as 'like.author',
				L.likePost as 'like.idLike'
				
				FROM post P LEFT OUTER JOIN likes L 
				ON P.idPost = L.likePost 
				WHERE P.idPost = ?
				ORDER BY P.datePost");
		
		$stmt->execute(array($idPost));
		$post_with_likes = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if(sizeof($post_with_likes)>0){
			$post = new Post($post[0]["post.id"], $post[0]["post.date"], $post[0]["post.content"],
					$post[0]["post.numLikes"], $post[0]["post.author"]);
			$likes_array = array();
			foreach ($post_with_likes as $like){
				$like = new Like(new User($like["like.author"]), $post);
				array_push($likes_array, $like);
			}
			$post->setLikes($likes_array);
			return $post;
		} else return NULL;
	}
	
	/**
	 * Carga todos los post con sus likes segun el autor
	 * @param string $idAuthor
	 * @return Post Las instancias de post|NULL en caso de no existir post
	 */
	public function findByAuthor(array $author){
		$stmt = $this->db->prepare("SELECT
				P.idPost as 'post.id',
				P.datePost as 'post.date',
				P.content as 'post.content',
				P.numLikes as 'post.numLikes',
				P.author as 'post.author',
				L.authorLike as 'like.author',
				L.likePost as 'like.idLike'
	
				FROM post P LEFT OUTER JOIN likes L
				ON P.idPost = L.likePost
				WHERE P.author = ?
				ORDER BY P.datePost");
	
		$stmt->execute(array($author));
		$post_with_likes = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
		if(sizeof($post_with_likes)>0){
			$post = new Post($post[0]["post.id"], $post[0]["post.date"], $post[0]["post.content"],
					$post[0]["post.numLikes"], $post[0]["post.author"]);
			$likes_array = array();
			foreach ($post_with_likes as $like){
				$like = new Like(new User($like["like.author"]), $post);
				array_push($likes_array, $like);
			}
			$post->setLikes($likes_array);
			return $post;
		} else return NULL;
	}
	
	
}










?>
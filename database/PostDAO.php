<?php
// file: database/PostDAO.php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../model/Like.php");
/**
 * Class UserDAO
 *
 * DAO que encapsula las sentencias SQL necesarias para gestionar los post de la BD
 * Implementa los metodos de almacenar post, buscar post por ID y buscar post por autor
 *
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */

class PostDAO {
	
	/**
	 * Referencia a la conexion PDO
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
	public function save(Post $post){
		$stmt = $this->db->prepare("INSERT INTO post(datePost,content,numLikes,author) values(?,?,?,?)");
		$stmt->execute(array($post->getDate(),$post->getContent(),0,$post->getAuthor()));
	}
	
	/**
	 * Carga un post segun su id
	 * @param string $idPost
	 * @throws PDOException si ocurre algun error en la BD
	 * @return Post La instancia de post|NULL en caso de no existir post con ese id 
	 */
	public function findByIdPost($id){
		$stmt = $this->db->prepare("SELECT * FROM post WHERE idPost = ?");
		$stmt->execute(array($id));
		$post = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if(sizeof($post)>0){
			return new Post($post["idPost"], $post["datePost"], $post["content"],
					$post["numLikes"], $post["author"]);
		} else return NULL;
	}
	
	/**
	 * Carga todos los post cuyo autor es un amigo del usuario
	 * @param string $idAuthor
	 * @throws PDOException si ocurre algun error en la BD
	 * @return Post Las instancias de post|NULL en caso de no existir post
	 */
	public function findPostsFriend($userEmail){
		$stmt = $this->db->prepare("SELECT * FROM post where author=?");
		$stmt->execute(array($userEmail));
		$posts =$stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$array_post = array();
		if(sizeof($posts)>0){
			foreach($posts as $post) {
				array_push($array_post, new Post($post["idPost"], $post["datePost"], $post["content"],
					$post["numLikes"], $post["author"]));
			}
		}
		
		if(!empty($array_post)){
			return $array_post;
		} else return null;
	}
	
	/**
	 * Carga todos los post con los comentarios cuyo autor es el usuario o 
	 * un amigo del usuario.
	 * @param User $author
	 * @return Post Las instancias de post con los comentarios|NULL en caso de no encontrar ningun post 
	 */
	public function findByAuthorWithComments(User $author) {
		$stmt = $this->db->prepare("SELECT P.idPost as 'post.id', 
				P.datePost as 'post.date', 
				P.content as 'post.content', 
				P.numLikes as 'post.likes', 
				P.author as 'post.author', 
				C.idComment as 'comment.id', 
				C.dateComment as 'comment.date', 
				C.content as 'comment.content', 
				C.numLikes as 'comment.likes', 
				C.author as 'comment.author', 
				C.idPost as 'comment.idPost' 
				FROM post P LEFT OUTER JOIN comments C ON P.idPost = C.idPost 
				WHERE P.author in 
					( 
					SELECT userEmail FROM friends WHERE friendEmail = ? AND isFriend='1' 
					UNION 
					SELECT friendEmail FROM friends WHERE userEmail = ? AND isFriend='1' 
					) 
				UNION 
				SELECT P.idPost as 'post.id', 
				P.datePost as 'post.date', 
				P.content as 'post.content', 
				P.numLikes as 'post.likes', 
				P.author as 'post.author', 
				C.idComment as 'comment.id', 
				C.dateComment as 'comment.date', 
				C.content as 'comment.content', 
				C.numLikes as 'comment.likes', 
				C.author as 'comment.author', 
				C.idPost as 'comment.idPost' 
				FROM post P LEFT OUTER JOIN comments C ON P.idPost = C.idPost 
				WHERE P.author = ? 
				ORDER BY `post.date` DESC, `comment.date` DESC");
		$stmt->execute(array($author->getEmail(),$author->getEmail(),$author->getEmail()));
		$postsWithComments = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$posts = array();
		if(sizeof($postsWithComments) > 0){
			foreach ($postsWithComments as $postwithcomments){
				
				if (!isset($posts[$postwithcomments["post.id"]])){
					$posts[$postwithcomments["post.id"]] = new Post($postwithcomments["post.id"],
							$postwithcomments["post.date"],
							$postwithcomments["post.content"],
							$postwithcomments["post.likes"],
							$postwithcomments["post.author"]);
				} 
				$post = $posts[$postwithcomments["post.id"]];
				if (isset($postwithcomments["comment.id"])){
					$comment = new Comment($postwithcomments["comment.id"],
									$postwithcomments["comment.date"],
									$postwithcomments["comment.content"],
									$postwithcomments["comment.likes"],
									$postwithcomments["comment.author"],
									$postwithcomments["comment.idPost"]);
					$post->addComment($comment);
				}
			}
			return $posts;
		}
		else {
			return NULL;
		}
	}
}
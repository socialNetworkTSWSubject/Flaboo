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
	public function save(Post $post){
		$stmt = $this->db->prepare("INSERT INTO post(datePost,content,numLikes,author) values(?,?,?,?)");
		$stmt->execute(array($post->getDate(),$post->getContent(),0,$post->getAuthor()));
	}
	
	/**
	 * Carga un post segun su id
	 * @param string $idPost
	 * @return Post Las instancia de post|NULL en caso de no existir post con ese id 
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
	 * Carga todos los post
	 * @param string $idAuthor
	 * @return Post Las instancias de post|NULL en caso de no existir post
	 */
	public function findByAuthor(User $author){
		$stmt = $this->db->prepare("SELECT * FROM post where author in 
		( 
			SELECT userEmail from friends where friendEmail = ? and isFriend='1' 
			UNION 
			SELECT friendEmail from friends where userEmail = 'adri@gmail.com' and isFriend='1' 
		)
		UNION SELECT * from post where author = ? 
		order by datePost");
		$stmt->execute(array($author->getEmail(),$author->getEmail()));
		$postFriends =$stmt->fetchAll(PDO::FETCH_ASSOC);
		
		
		$array_post = array();
		if(sizeof($postFriends)>0){
			foreach($postFriends as $postFriend) {
				array_push($array_post, new Post($postFriend["idPost"], $postFriend["datePost"], $postFriend["content"],
					$postFriend["numLikes"], $postFriend["author"]));
			}
		}
		
		if(!empty($array_post)){
			return $array_post;
		} else return null;
	}
}
?>
	



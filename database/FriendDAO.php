<?php
// file: database/UserDAO.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
 * Class UserDAO
 *
 * Database interface for User entities
 * 
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */
class FriendDAO {
  /**
   * Referencia a la nonexión PDO
   * @var PDO
   */
  private $db;
  
  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }
  
  
  /**
   * Guarda un usuario en la base de datos
   * 
   * @param User $user El usuario a ser guardado
   * @throws PDOException Si ocurre un error de base de datos
   * @return void
   */      
  public function save($friend) {
 
    $stmt = $this->db->prepare("INSERT INTO friends (userEmail,friendEmail,isFriend) values (?,?,?)");
    $stmt->execute(array($friend->getUserEmail(), $friend->getFriendEmail(), $friend->getIsFriend()));  
  }
  
  public function updateIsFriend($friendship){
	$stmt = $this->db->prepare("UPDATE friends set isFriend=1 where userEmail=? and friendEmail=?");
    $stmt->execute(array($friendship->getUserEmail(), $friendship->getFriendEmail()));  
  }
  
  public function deleteFriendship($friendship){
	$stmt = $this->db->prepare("DELETE from friends WHERE userEmail=? and friendEmail=?");
    $stmt->execute(array($friendship->getUserEmail(),$friendship->getFriendEmail()));  
  }
  
  
   /**
   * Loads a Post from the database given its id
   * 
   * Note: Comments are not added to the Post
   *
   * @throws PDOException if a database error occurs
   * @return Post The Post instances (without comments). NULL 
   * if the Post is not found
   */    
  public function findFriends($currentuser){ ///revisar????????????????????????????????????????''
    $stmt = $this->db->prepare("SELECT * FROM friends, users WHERE friends.userEmail=? and users.email=friends.friendEmail and friends.isFriend='1'");//como poner el true solo va con 1 con true no?????????????????
    $stmt->execute(array($currentuser->getEmail()));
    //$user = $stmt->fetch(PDO::FETCH_ASSOC);
	$friends_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$friends=array();
	
	foreach ($friends_db as $friend) {
		array_push($friends, new User($friend["email"], $friend["password"], $friend["name"]));
    }   
	
    return $friends;
     
  }
  
  
  public function findPeticion($currentuser, $friendEmail){
 
	$stmt = $this->db->prepare("SELECT * FROM friends WHERE userEmail=? and friendEmail=?");
    $stmt->execute(array($friendEmail,$currentuser->getEmail()));
	
	$friendship = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if(!sizeof($friendship) == 0) {
		return new Friend(
			$friendship["userEmail"],
			$friendship["friendEmail"],
			$friendship["isFriend"]
		);
    } else {
		return NULL;
    } 
  }
  
  
  
  
  public function findFriendship($currentuser, $friendEmail){
 
	$stmt = $this->db->prepare("SELECT * FROM users,friends WHERE friends.userEmail=? and users.email=friends.???????????????????????????????????????????????");
    $stmt->execute(array($currentuser->getEmail(),$friendEmail,));
	
	$friendship = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if(!sizeof($friendship) == 0) {
		return new Friend(
			$friendship["userEmail"],
			$friendship["friendEmail"],
			$friendship["isFriend"]
		);
    } else {
		return NULL;
    } 
  }
  /*
  public function findFriendship2($currentuser, $friendEmail){
 
	$stmt = $this->db->prepare("SELECT * FROM friends WHERE userEmail=? and friendEmail=?");
    $stmt->execute(array($currentuser->getEmail(),$friendEmail));
	
	$friendship = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if(!sizeof($friendship) == 0) {
		return new Friend(
			$friendship["userEmail"],
			$friendship["friendEmail"],
			$friendship["isFriend"]
		);
    } else {
		return NULL;
    } 
  }
  */
  
  /**
   * Loads a Post from the database given its id
   * 
   * Note: Comments are not added to the Post
   *
   * @throws PDOException if a database error occurs
   * @return Post The Post instances (without comments). NULL 
   * if the Post is not found
   */    
  public function findUsuarios($currentuser){ ///revisar????????????????????????????????????????''
  
    $stmt = $this->db->prepare("SELECT * FROM users where email not in 
								(
									SELECT userEmail from friends where friendEmail = ?
									UNION
									SELECT friendEmail from friends where userEmail = ?
								) and email!=?"	);
    $stmt->execute(array($currentuser->getEmail(),$currentuser->getEmail(),$currentuser->getEmail()));
    //$user = $stmt->fetch(PDO::FETCH_ASSOC);
	$friends_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$friends=array();
	
	foreach ($friends_db as $friend) {
		array_push($friends, new User($friend["email"], $friend["password"], $friend["name"]));
    }   
	
    return $friends;
     
  }
  
  
  public function saveFriedship($currentuser, $friendEmail){ 
  
	$stmt = $this->db->prepare("INSERT INTO friends(userEmail, friendEmail, isFriend) values (?,?,0)");
    $stmt->execute(array($currentuser->getEmail(), $friendEmail)); 
  
  }
  
  
  /**
   * Loads a Post from the database given its id
   * 
   * Note: Comments are not added to the Post
   *
   * @throws PDOException if a database error occurs
   * @return Post The Post instances (without comments). NULL 
   * if the Post is not found
   */    
  public function findSolicitudes($currentuser){ ///revisar????????????????????????????????????????''
 
    $stmt = $this->db->prepare("SELECT * FROM friends, users WHERE friends.friendEmail=? and users.email=friends.userEmail and friends.isFriend='0' ");//como poner el true ?????????????????
    $stmt->execute(array($currentuser->getEmail()));
    //$user = $stmt->fetch(PDO::FETCH_ASSOC);
	$solicitudes_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$solicitudes=array();
	
	foreach ($solicitudes_db as $solicitud) {
		array_push($solicitudes, new User($solicitud["email"], $solicitud["password"], $solicitud["name"]));
    }   
	
    return $solicitudes;
     
  }
  
  
  
  
 
}
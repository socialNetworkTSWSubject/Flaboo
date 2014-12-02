<?php

require_once(__DIR__."/../core/PDOConnection.php");

/**
 * Class FriendDAO
 *
 * 
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */
class FriendDAO {
  /**
   * Referencia a la nonexión PDO
   * @var db
   */
  private $db;
  
  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }
  
  
  /**
   * Guarda la amistad en la base de datos
   * 
   * @param Friend $friend La amistad a ser guardada
   * @return void
   */      
  public function save($friend) {
 
    $stmt = $this->db->prepare("INSERT INTO friends (userEmail,friendEmail,isFriend) values (?,?,?)");
    $stmt->execute(array($friend->getUserEmail(), $friend->getFriendEmail(), $friend->getIsFriend()));  
  }
  
  /**
   * Actualiza la variable setFriends a '1'
   * 
   * @param Friend $friendship La amistad a ser actualizada
   * @return void
   */ 
  public function updateIsFriend($friendship){
	$stmt = $this->db->prepare("UPDATE friends set isFriend=1 where userEmail=? and friendEmail=?");
    $stmt->execute(array($friendship->getUserEmail(), $friendship->getFriendEmail()));  
  }
  
  /**
   * Borra la amistad
   * 
   * @param Friend $friendship La amistad a ser borrada
   * @return void
   */ 
  public function deleteFriendship($friendship){
	$stmt = $this->db->prepare("DELETE from friends WHERE userEmail=? and friendEmail=?");
    $stmt->execute(array($friendship->getUserEmail(),$friendship->getFriendEmail()));  
  }
  
  /**
   * Encuentra los amigos de currentuser
   * 
   * @param User $currentuser El usuario actual
   * @return array()
   */    
  public function findFriends($currentuser){ 
    $stmt = $this->db->prepare("SELECT * FROM users where email in 
								(
									SELECT userEmail from friends where friendEmail = ? and isFriend='1'
									UNION
									SELECT friendEmail from friends where userEmail = ? and isFriend='1'
								)"	);
    $stmt->execute(array($currentuser->getEmail(),$currentuser->getEmail()));
	$friends_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$friends=array();
	
	foreach ($friends_db as $friend) {
		array_push($friends, new User($friend["email"], $friend["password"], $friend["name"]));
    }   
	
    return $friends;
     
  }
  
  /**
   * Encuentra la peticion de amistad entre el currentuser y el usuario
   * con el que busca la amistad
   * 
   * @param User $currentuser El usuario actual
   * @param User $friendEmail El usuario de la peticion
   * @return Friend
   */ 
  public function findPeticion($currentuser, $friendEmail){
 
	$stmt = $this->db->prepare("SELECT * FROM friends WHERE userEmail=? and friendEmail=? and isFriend='0'");
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
  
  /**
   * Encuentra la relacion de amistad entre los usuarios
   * 
   * @param User $currentuser El usuario actual
   * @param User $friendEmail El usuario amigos
   * @return Friend
   */ 
  public function findFriendship($currentuser, $friendEmail){
 
	$stmt = $this->db->prepare("SELECT * FROM friends WHERE (friends.userEmail=? and friends.friendEmail=? )
																OR (friends.userEmail=? and friends.friendEmail=?) and isFriend='1'");
    $stmt->execute(array($currentuser->getEmail(),$friendEmail,$friendEmail,$currentuser->getEmail()));
	
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

  
  /**
   * Encuentra los usuarios que no tienen ningun tipo de 
   * relacion de amistad con el curretuser
   * 
   * @param User $currentuser El usuario actual
   * @return array de Friends
   */     
  public function findUsuarios($currentuser){ 
  
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
  
  /**
   * Guarda la relacion de amistad entre el currentuser y el
   * usuario al que realiza la peticion de amistad
   * 
   * @param User $currentuser El usuario actual
   * @param User $friendEmail El usuario amigo
   * @return array de Friends
   */
  public function saveFriedship($currentuser, $friendEmail){ 
  
	$stmt = $this->db->prepare("INSERT INTO friends(userEmail, friendEmail, isFriend) values (?,?,0)");
    $stmt->execute(array($currentuser->getEmail(), $friendEmail)); 
  
  }
  
  /**
   * Encuentra las solicitudes de amistad que tiene el currentuser
   * 
   * @param User $currentuser El usuario actual
   * @return array de Friends
   */   
  public function findSolicitudes($currentuser){ 
 
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
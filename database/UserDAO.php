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
class UserDAO {
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
  public function save($user) {
 
  
    $stmt = $this->db->prepare("INSERT INTO users (email,password,name) values (?,?,?)");
	 echo $user->getEmail();
	echo $user->getPassword();
	echo $user->getName();
	
    $stmt->execute(array($user->getEmail(), $user->getPassword(), $user->getName()));  
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
  public function findByEmail($useremail){
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute(array($useremail));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!sizeof($user) == 0) {
		return new User(
			$user["email"],
			$user["password"],
			$user["name"]
		);
    } else {
		return NULL;
    }   
  }
  
  
  
  
  
  /**
   * Mira si el email ya existe en la base de datos
   * 
   * @param string $email El email a comprobar
   * @return boolean true Si el email existe, false en otro caso
   */
  public function emailExists($email) {
    $stmt = $this->db->prepare("SELECT count(email) FROM users where email=?");
    $stmt->execute(array($email));
    
    if ($stmt->fetchColumn() > 0) {   
      return true;
    } 
	//return false?????????????????????????????????
  }
  
  /**
   * Comprueba si el par email/password existen en la base de datos
   * 
   * @param string $email El email
   * @param string $passwd La contraseña
   * @return boolean true Si el par email/passwrod existe, false en otro caso.
   */
  public function isValidUser($email, $password) {
    $stmt = $this->db->prepare("SELECT count(email) FROM users where email=? and password=?");
    $stmt->execute(array($email, $password));
    
    if ($stmt->fetchColumn() > 0) {
      return true;        
    }
  }
}
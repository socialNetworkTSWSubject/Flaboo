<?php

require_once(__DIR__."/../core/PDOConnection.php");

/**
 * Class UserDAO
 *
 * 
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */
class UserDAO {
  /**
   * Referencia a la conexión PDO
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
   * @return void
   */      
  public function save($user) {
    $stmt = $this->db->prepare("INSERT INTO users (email,password,name) values (?,?,?)");
    $stmt->execute(array($user->getEmail(), $user->getPassword(), $user->getName()));  
  }
  
  
   /**
   * Encuentra un usuario en la base de datos con su email.
   * 
   * @param String $useremail El email del usuario
   * @return Friend 
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
   * Comprueba si el email ya existe en la base de datos
   * 
   * @param String $email El email del usuario
   * @return Boolean 
   */
  public function emailExists($email) {
    $stmt = $this->db->prepare("SELECT count(email) FROM users where email=?");
    $stmt->execute(array($email));
    
    if ($stmt->fetchColumn() > 0) {   
      return true;
    } 
  }
  
  /**
   * Comprueba si el email y la contraseña
   * son validos para hacer login
   * 
   * @param String $email El email del usuario
   * @param String $password El email del usuario
   * @return Boolean 
   */
  public function isValidUser($email, $password) {
    $stmt = $this->db->prepare("SELECT count(email) FROM users where email=? and password=?");
    $stmt->execute(array($email, $password));
    
    if ($stmt->fetchColumn() > 0) {
      return true;        
    }
  }
}
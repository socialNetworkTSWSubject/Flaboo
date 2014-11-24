<?php
// file: model/Friend.php

require_once(__DIR__."/../core/ValidationException.php");

/**
 * Class User
 * 
 * Representa un usuario en la red social
 * 
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */
class Friend {
  /**
   * El email del usuario
   * @var string
   */
  private $userEmail;
  /**
   * La contraseña del usuario
   * @var string
   */
  private $friendEmail;
    /**
   * El nombre del usuario
   * @var string
   */
  private $isFriend;
  
  /**
   * El constructor
   * 
   * @param string $email El email del usuario
   * @param string $password La contraseña del usuario
   * @param string $name El nombre del usuario
   */
  public function __construct($userEmail=NULL, $friendEmail=NULL, $isFriend=NULL) {
    $this->userEmail = $userEmail;
    $this->friendEmail = $friendEmail;   
	$this->isFriend = $isFriend; 
  }
  /**
   * Devuelve el email de ese usuario
   * 
   * @return string El email de ese usuario
   */  
  public function getUserEmail() {
    return $this->userEmail;
  }
  /**
   * Modifica el email de ese usuario
   * 
   * @param string $email El email de ese usuario
   * @return void
   */  
  public function setUserEmail($userEmail) {
    $this->userEmail = $userEmail;
  }
  
  /**
   * Devuelve la contraseña de ese usuario
   * 
   * @return string la contraseña de ese usuario
   */  
  public function getFriendEmail() {
    return $this->friendEmail;
  }  
  /**
   * Modifica la contraseña de ese usuario
   * 
   * @param string $password la contraseña de ese usuario
   * @return void
   */    
  public function setFriendEmail($friendEmail) {
    $this->friendEmail = $friendEmail;
  }
   /**
   * Devuelve el nombre de ese usuario
   * 
   * @return string el nombre de ese usuario
   */  
  public function getIsFriend() {
    return $this->isFriend;
  }  
  /**
   * Modifica nombre de ese usuario
   * 
   * @param string $name el nombre de ese usuario
   * @return void
   */    
  public function setIsFriend($isFriend) {
    $this->isFriend = $isFriend;
  }
 
}
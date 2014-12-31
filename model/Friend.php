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
   * El email del usuario amigo
   * @var string
   */
  private $friendEmail;
    /**
   * Variable de amistad (1=amigos, 0=peticion)
   * @var string
   */
  private $isFriend;
  
  /**
   * El constructor
   * 
   * @param string $userEmail El email del usuario
   * @param string $friendEmail El email del usuario amigo
   * @param string $isFriend Variable de amistad (1=amigos, 0=peticion)
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
   * @param string $userEmail El email de ese usuario
   * @return void
   */  
  public function setUserEmail($userEmail) {
    $this->userEmail = $userEmail;
  }
  
  /**
   * Devuelve el email del usuario amigo
   * 
   * @return string El email del usuario amigo
   */  
  public function getFriendEmail() {
    return $this->friendEmail;
  }  
  /**
   * Modifica El email del usuario amigo
   * 
   * @param string $friendEmail El email del usuario amigo
   * @return void
   */    
  public function setFriendEmail($friendEmail) {
    $this->friendEmail = $friendEmail;
  }
   /**
   * Devuelve Variable de amistad (1=amigos, 0=peticion)
   * 
   * @return boolean Variable de amistad (1=amigos, 0=peticion)
   */  
  public function getIsFriend() {
    return $this->isFriend;
  }  
  /**
   * Modifica Variable de amistad (1=amigos, 0=peticion)
   * 
   * @param boolean $isFriend Variable de amistad (1=amigos, 0=peticion)
   * @return void
   */    
  public function setIsFriend($isFriend) {
    $this->isFriend = $isFriend;
  }
 
}
<?php
//file: core/ValidationException.php
/**
 * Class ValidationException
 * 
 * Incluye un array de errores para la validación de datos.
 *
 * El array de errores contiene validación de errores.
 * 
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */
class ValidationException extends Exception {
  
  /**
   * array de errores
   * @var mixed
   */
  private $errors = array();
  
  public function __construct(array $errors, $msg=NULL){
    parent::__construct($msg);
    $this->errors = $errors;
  }
  
  /**
   * Devuelve la validación de errores
   * 
   * @return mixed La validación de errores
   */
  public function getErrors() {
    return $this->errors;
  }
}
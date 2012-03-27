<?php

/**
 * Template Class 
 * 
 * Derived from Clingwrap (Mai Yifan)
 * Available at github.com/myffical/clingwrap
 **/

class Template {

  var $params = array();
  var $filepath = '';
  
  function __construct($filepath){
    $this->set_filepath($filepath);
  }
  
  function set_filepath($filepath){
      $this->filepath = realpath($filepath);
  }
  
  function get_filepath(){
    return $this->filepath;
  }
  /**
    * Sets the parameter given by key to the value,
    * overriding the previous value if any.
    *
    * @param string $key - Key to store the value under
    * @param object $value - Object to be stored, can be of any type
    */
  function set_param($key, $value){
    if($key && $value){
      $this->params[$key] = $value;
    }
  }
  
  function get_params(){
    return $this->params;
  }
  
  /**
    * Sets the parameter given by key to the value,
    *
    * @param string $key - Key underwhich the value is stored
    */
  function get_param($key){
    if($key && $params[$key]){
      return $params[$key];
    }
    else{
      return NULL;
    }
  }
}

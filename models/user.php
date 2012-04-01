<?php

/**
 * This is a data model containing the User class, representing a single
 * user on the system
 **/

class User {
	
	private $id;
	private $set_field = array('email_address', 'password', 'full_name');
	private $get_field = array('id', 'email_address', 'password', 'full_name');
		
	public function __construct($id) {
		$this->id = (int)$id;
	}
	
	public function __set($name, $value) {
		if(!in_array($name, $this->set_field)) 
			error("You cannot set property $name for Users.");
		
		if($name == 'password')
			$value = sha1($this->__get('email_address') . $value);
		
		mysql_query('UPDATE `users` SET `'.$name.'` = \"'.mysql_real_escape_string($value).'\" WHERE `id` = '.$this->id);
	}
	
	public function __get($name) {
		if(!in_array($name, $this->get_field)) 
			error("You cannot get property $name for Users.");
		$r = mysql_fetch_assoc(mysql_query('SELECT `'.$name.'` FROM `users` WHERE `id` = '.$this->id));
		if(!is_array($r)) 
			error("The user does not exist.");
		return $r[$name];
	}
	
	public function getPhotostream() {
		return new Photostream($this->id);
	}
	
	public function getSets() {
		$sets = array();
		$s_r = mysql_query('SELECT `id` FROM `sets` WHERE `user_id` = '.$this->id);
		while($s = mysql_fetch_assoc($s_r)) {
			$sets[] = new Photoset($s['id']);
		}
		return $sets;
	}
	
	public function compare_password($password) {
		return sha1($this->__get('email_address') . $password) == $this->__get('password');
	}
	
	public static function create($email_address, $password, $full_name) {
		$password = sha1($email_address . $password);
		mysql_query('INSERT INTO `users` (`email_address`, `password`, `full_name`) VALUES
					 ("'.mysql_real_escape_string($email_address).'",'.
					 '"'.mysql_real_escape_string($password).'",'.
					 '"'.mysql_real_escape_string($full_name).'")');
				
		if(mysql_affected_rows() != 1) return null;		 
		
		return new User(mysql_insert_id());
	}
	
	public static function get_by_email($email_address) {
		$g = mysql_fetch_assoc(mysql_query('SELECT `id` FROM `users` WHERE `email_address` = "'.mysql_real_escape_string($email_address).'"'));
		if(is_array($g)) 
			return new User($g['id']);
		else
			return null;
	}
	
}

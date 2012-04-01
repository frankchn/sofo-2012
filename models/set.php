<?php

class Photoset {
	
	private $id;
	private $current_index;
	
	private $set_field = array('title', 'description');
	private $get_field = array('id', 'title', 'description');	
	
	public function __construct($id) {
		$this->id = (int)$id;
	}
	
	public function __set($name, $value) {
		if(!in_array($name, $this->set_field)) 
			error("You cannot set property $name for Users.");
		
		mysql_query('UPDATE `sets` SET `'.$name.'` = \"'.mysql_real_escape_string($value).'\" WHERE `id` = '.$this->id);
	}
	
	public function __get($name) {
		if(!in_array($name, $this->get_field)) 
			error("You cannot get property $name for Users.");
		$r = mysql_fetch_assoc(mysql_query('SELECT `'.$name.'` FROM `sets` WHERE `id` = '.$this->id));
		if(!is_array($r)) 
			error("This set does not exist.");
		return $r[$name];
	}
	
	public function addPhoto($photo) {
		mysql_query('INSERT INTO `sets_photos` (`set_id`, `photo_id`) VALUES ('.$this->id.','.$photo->id.')');
	}
	
	public function removePhoto($photo) {
		mysql_query('DELETE FROM `sets_photos` WHERE `photo_id` = '.$photo->id.' AND `set_id` = '.$this->id);
	}
	
	public function getRandomPhoto() {
		$p_r = mysql_fetch_assoc(mysql_query('SELECT `photo_id` FROM `sets_photos` WHERE `set_id` = '.$this->id.' ORDER BY RAND() LIMIT 0,1'));
		if(is_array($p_r) > 0) {
			return new Photo($p_r['photo_id']);
		} else {
			return null;
		}
	}
	
	public function getPhotos() {
		$photos = array();
		$p_r = mysql_query('SELECT `photo_id` FROM `sets_photos` WHERE `set_id` = '.$this->id);
		while($p = mysql_fetch_assoc($p_r)) {
			$photos[] = new Photo($p['photo_id']);
		}
		return $photos;
	}
	
	public static function create($title, $description) {
		global $user;
		
		mysql_query('INSERT INTO `sets` (`user_id`, `title`, `description`) VALUES ('.$user->id.',"'.mysql_real_escape_string($title).'","'.mysql_real_escape_string($description).'")');
		return new Photoset(mysql_insert_id());
	}
	
}

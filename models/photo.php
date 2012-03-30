<?php

class Photo {
	
	private $id;
	private $set_field = array('user_id', 'title', 'description', 'file_name', 'uploaded_time');
	private $get_field = array('id', 'user_id', 'title', 'description', 'file_name', 'uploaded_time');

	public function __construct($id) {
		$this->id = (int)$id;
	}
	
	public function __set($name, $value) {
		if(!in_array($name, $this->set_field)) 
			error("You cannot set property $name for Photos.");
		
		mysql_query('UPDATE `photos` SET `'.$name.'` = \"'.mysql_real_escape_string($value).'\" WHERE `id` = '.$this->id);
	}
	
	public function __get($name) {
		if(!in_array($name, $this->get_field)) 
			error("You cannot get property $name for Photos.");
		$r = mysql_fetch_assoc(mysql_query('SELECT `'.$name.'` FROM `photos` WHERE `id` = '.$this->id));
		
		if(!is_array($r)) 
			error("The photo does not exist.");
		return $r[$name];
	}
	
	public function getImageURL($type = 'small') {
		return '../upload/'.$this->__get('file_name').'_'.$type.'.png';
	}
	
	public static function getRandomImage() {
		$fphoto = mysql_fetch_assoc(mysql_query('SELECT `id` FROM `photos` ORDER BY RAND() LIMIT 0,1'));
		if(is_array($fphoto)) {
			return new Photo($fphoto['id']);
		} else {
			return null;
		}
	}
	
	public static function createNewImage($title, $description, $file_name, $extension) {
		global $user;
		
		$im = null;
		switch($extension) {
			case 'gif':
				$im = imagecreatefromgif($file_name);
				break;
			case 'jpeg': case 'jpg':
				$im = imagecreatefromjpeg($file_name);
				break;
			case 'png':
				$im = imagecreatefrompng($file_name);
				break;
			default:
				return false;
		}
		
		if(!is_resource($im)) { 
			return false;
		}
		
		// actual_size
		$original_x = imagesx($im);
		$original_y = imagesy($im);
		
		$output_images = array('original' => $im);
		
		foreach(get_image_sizes() as $name => $dimensions) {
			$w_scale = $dimensions['x'] / $original_x;
			$h_scale = $dimensions['y'] / $original_y;
			$scale = min($w_scale, $h_scale);
			
			$new_x = $original_x * $scale;
			$new_y = $original_y * $scale;
			
			$new_image = imagecreatetruecolor($new_x, $new_y);
			imagecopyresized($new_image, $output_images['original'], 0, 0, 0, 0, $new_x, $new_y, $original_x, $original_y);
			
			$output_images[$name] = $new_image;
		}
		
		$image_name = sha1(microtime().uniqid('', true));
			
		foreach($output_images as $name => $im) {
			$name = UPLOAD_DIRECTORY.$image_name.'_'.$name.'.png';
			imagepng($im, $name, 3);
		}

		mysql_query('INSERT INTO `photos` (`user_id`, `title`, `description`, `file_name`, `uploaded_time`) VALUES ('.
						 $user->id.','.
					 '"'.mysql_real_escape_string($title).'",'.
					 '"'.mysql_real_escape_string($description).'",'.
					 '"'.mysql_real_escape_string($image_name).'",'.
						 time().')');		
						 
		return new Photo(mysql_insert_id());	
	}

}

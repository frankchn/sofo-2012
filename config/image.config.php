<?php

function get_image_sizes() {
  return array(
	'thumb' =>  array('x' => 125, 'y' => 125, 'name' => 'Thumbnail'),
	'small' =>  array('x' => 800, 'y' => 600, 'name' => 'Small'),
	'medium' => array('x' => 1600, 'y' => 1200, 'name' => 'Medium'),
	'large' =>  array('x' => 3200, 'y' => 2400, 'name' => 'Large'),
  );
}

define('UPLOAD_DIRECTORY', '/home/soco/sofo-2012/upload/');

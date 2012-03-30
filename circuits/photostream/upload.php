<?php

require_login();

$success_message = '';
$error_message = '';

if(isset($_POST['upload'])) {
	if(!isset($_FILES['image'])) {
		$error_message = ('Sorry, but you did not upload an image file. Please try again.');
		goto render_template;
	}
	
	if(!isset($_POST['title']) || empty($_POST['title']) || 
	   !isset($_POST['description']) || empty($_POST['description'])) {
		$error_message = 'You need to enter a title and a description for your photo to continue.';
		goto render_template;
	}
	
	$extension = strtolower(end(explode('.', $_FILES['image']['name']))); 
	$return = Photo::createNewImage($_POST['title'], $_POST['description'], $_FILES['image']['tmp_name'], $extension);
	
	if(!$return) {
		$error_message = 'Sorry, but we do not support this image format at the moment. We only support PNG, JPEG and GIF files';
		goto render_template;
	}
	
	$success_message = 'Congratulations! Image uploaded successfully.';
}

render_template:
	$template = new Template('templates/upload.php');
	$template->set_param('success_message', $success_message);
	$template->set_param('error_message', $error_message);
	$template_manager->add_template('content', $template);
	
?>

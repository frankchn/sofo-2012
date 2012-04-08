<?php

if(is_object($user)) {
	$photostream = new Photostream($user->id);
} else {
	die("You need to login to create a new set.");
}

if(isset($_POST['submit'])) {
	$photoset = Photoset::create($_POST['title'], $_POST['description']);
	if(isset($_POST['photo'])) {
		foreach($_POST['photo'] as $photo_id) {
			$photoset->addPhoto(new Photo($photo_id));
		}
	}
	header("Location: ../home/welcome");
	die();
}

$template = new Template('templates/add.php');
$template->set_param('photostream', $photostream);
$template_manager->add_template('content', $template);

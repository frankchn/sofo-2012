<?php

$photo = new Photo($_GET['photo']);
$photostream = new Photostream($photo->user_id);
$photostream->setIndex($photo->id);

render_form:
	$template = new Template('templates/view.php');
	$template->set_param('photo', $photo);
	$template->set_param('photostream', $photostream);
	$template->set_param('user', $user);
	$template_manager->add_template('content', $template);
	

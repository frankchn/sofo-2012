<?php

if($user == null) {
	$template = new Template('templates/welcome.php');
	$template->set_param('frontpage_photo', Photo::getRandomImage());
	$template_manager->add_template('content', $template);
} else {
	$template = new Template('templates/dashboard.php');
	$template->set_param('photostream', new Photostream());
	$template_manager->add_template('content', $template);
}

<?php

if($user == null) {
	$template = new Template('templates/welcome.php');
	$template_manager->add_template('content', $template);
} else {
	$template = new Template('templates/dashboard.php');
	$template_manager->add_template('content', $template);
}

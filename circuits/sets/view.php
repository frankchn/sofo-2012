<?php

if(!isset($_GET['set']))
	error('Sorry, but you must specify a set');

$set = new Photoset($_GET['set']);

$template = new Template('templates/view.php');
$template->set_param('set', $set);
$template->set_param('user', $user);
$template_manager->add_template('content', $template);

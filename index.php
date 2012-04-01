<?php

/**
 * Core Renderer
 * 
 * This file handles all requests, includes appropriate files and
 * in general sets the environment up 
 **/

error_reporting(E_ALL | E_STRICT);

require_once('config/database.config.php');
require_once('config/image.config.php');
require_once('lib/init/init.php');
require_once('lib/init/functions.php');

/* Template Engine */
require_once('lib/templates/manager.php');
require_once('lib/templates/template.php');

/* Relevant Classes */
require_once('models/user.php');
require_once('models/photo.php');
require_once('models/photostream.php');
require_once('models/set.php');

/* Retrieve the Circuit and Action */
list($circuit, $action) = explode('/', $_GET['rewrite'], 2);
$circuit = preg_replace('/[^A-Za-z0-9_-]/', '', $circuit);
$action = preg_replace('/[^A-Za-z0-9_-]/', '', $action);

$template_manager = new TemplateManager();
$base_template = new Template('templates/base.php');

if(isset($_SESSION['user_id']))
	$user = new User($_SESSION['user_id']);
else
	$user = null;

function __go_circuit() {
	global $template_manager, $base_template, $circuit, $action, $user;
	chdir('circuits/'.$circuit);
	if(!file_exists($action.'.php')) error($circuit . '/' . $action . ' not found.');
	require($action.'.php');
	chdir('../../');
}

__go_circuit();

$base_template->set_param('content', $template_manager->render('content', false));
$base_template->set_param('user', $user);

$template_manager->add_template('basic_template', $base_template);
$template_manager->set_base('basic_template');
$template_manager->render_base();

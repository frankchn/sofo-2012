<?php

/**
 * Core Renderer
 * 
 * This file handles all requests, includes appropriate files and
 * in general sets the environment up 
 **/

error_reporting(E_ALL | E_STRICT);

require_once('config/database.config.php');
require_once('lib/init/init.php');
require_once('lib/init/functions.php');

/* Template Engine */
require_once('lib/templates/manager.php');
require_once('lib/templates/template.php');

/* Retrieve the Circuit and Action */
list($circuit, $action) = explode('/', $_GET['rewrite'], 2);
$circuit = preg_replace('/[^A-Za-z0-9_-]/', '', $circuit);
$action = preg_replace('/[^A-Za-z0-9_-]/', '', $action);

$template_manager = new TemplateManager();
$base_template = new Template('templates/base.php');

function __go_circuit() {
	global $template_manager, $base_template, $circuit, $action;
	chdir('circuits/'.$circuit);
	require($action.'.php');
	chdir('../../');
}

__go_circuit();

$base_template->set_param('content', $template_manager->render('content', false));

$template_manager->add_template('basic_template', $base_template);
$template_manager->set_base('basic_template');
$template_manager->render_base();

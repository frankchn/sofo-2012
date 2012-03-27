<?php

$message = '';

if(isset($_POST['signup'])) {
	if(User::get_by_email($_POST['email']) != null) {
		$message = 'There is another user already registered with this email address. Please try again.';
		goto render_form;
	}
	
	$user = User::create($_POST['email'], $_POST['password'], $_POST['full_name']);
	if($user == null) 
		error('User creation failed.');
		
	$template = new Template('templates/signup_success.php');
	$template_manager->add_template('content', $template);
	return;
} 

render_form:
	$template = new Template('templates/signup_form.php');
	$template->set_param('message', $message);
	$template_manager->add_template('content', $template);

<?php

if(isset($_POST['signup'])) {
	if(User::get_by_email($_POST['email']) != null) 
		error('There is another user already registered with this email address. Please try again.');
	
	$user = User::create($_POST['email'], $_POST['password'], $_POST['full_name']);
	if($user == null) 
		error('User creation failed.');
		
	$template = new Template('templates/signup_success.php');
	$template_manager->add_template('content', $template);
} else {
	$template = new Template('templates/signup_form.php');
	$template_manager->add_template('content', $template);
}

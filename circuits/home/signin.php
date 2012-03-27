<?php

$message = '';

if(isset($_POST['signin'])) {
	$user = User::get_by_email($_POST['email']);
	if($user == null) {
		$message = 'Sorry, you did not enter a correct email address. Please try again.';
		goto render_form;
	}
	
	if(!$user->compare_password($_POST['password'])) {
		$message = 'Sorry, you did not enter a correct password. Please try again.';
		goto render_form;
	}
	
	$_SESSION['user_id'] = $user->id;
	redirect(create_link('home/welcome'));
}

render_form:
	$template = new Template('templates/signin_form.php');
	$template->set_param('message', $message);
	$template_manager->add_template('content', $template);

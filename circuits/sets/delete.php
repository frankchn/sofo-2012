<?php

if(!isset($_GET['id']))
	error('You need to specify a set to delete');

$set = new Photoset($_GET['id']);
if($set->user_id == $user->id) {
	$set->delete();
	header("Location: ../home/welcome");
} else {
	error('This is not your set! You can\'t delete it.');
}

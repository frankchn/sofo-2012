<?php

if(!isset($_GET['photo']))
	error('You need to specify a photo to delete');
	
$photo = new Photo($_GET['photo']);
if($photo->user_id == $user->id) {
	$photo->delete();
	header("Location: ../photostream/view");
} else {
	error('This is not your photo! You can\'t delete it.');
}

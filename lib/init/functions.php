<?php

function error($message) {
	echo "<strong>Internal Server Error: $message</strong>";
	die();
}

function redirect($url) {
	header("Location: $url");
	die();
}

function create_link($action, $get_params = array()) {
	if(count($get_params) > 0)
		return '../'.$action.'?'.http_build_query($get_params);
	else
		return '../'.$action;
}

function _s($s) {
	return htmlspecialchars($s);
}

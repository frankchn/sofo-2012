<?php

function error($message) {
	echo "<strong>Internal Server Error: $message</strong>";
	die();
}

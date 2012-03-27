<?php

$link = mysql_connect($database['hostname'], $database['username'], $database['password']);
if(!is_resource($link)) die("MySQL connect failed with ".mysql_error());

mysql_select_db($database['database']);

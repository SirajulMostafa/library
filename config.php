<?php
	$dbcon = mysql_connect('localhost', 'root', '') or die("Could not connect: " . mysql_error());
	mysql_select_db('library', $dbcon) or die("Could not find: " . mysql_error());
?>

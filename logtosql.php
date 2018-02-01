<?php
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = '';
	$db_name = 'pai_jaros';
	$polaczenie = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	if (!$polaczenie) {
		die('Wystąpił błąd połączenia: ' . mysqli_connect_errno());
	}
	@mysqli_query($polaczenie, 'SET NAMES utf8');
?>
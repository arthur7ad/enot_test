<?php
	require_once 'core/initPublic.php';

	$user = new User();
	$user->logout();

	Redirect::to('index.php');
?>
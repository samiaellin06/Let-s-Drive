<?php 
	 session_start();
	session_destroy();
	header("location:AdminLogIn.php"); 
?>
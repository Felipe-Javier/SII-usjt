<?php
	
	session_start();
	session_destroy();
	header("location: ../Iniciar_Sesion.php");

?>
<?php
    session_start();
		if (!isset($_SESSION["login"]))
		header("location:login.php");
	//autentica se a sessao foi iniciada
?>
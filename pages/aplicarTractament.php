<?php
	session_start();
    include("fn.php");
	PIni();
	MenuSupIni();
	MenuSupExemple();
	MenuSupFi();
	MenuLatIni();
	MenuLatExempleVeterinari();
	MenuLatFi();
	ContingutIni();
	$idu=$_SESSION['id'];
	$id_vedell = $_GET['id_vedell'];
	$connexio=connectar();
	
	echo"<table>";
	echo"<form action='accio.php?accio=aplicar_tractament' method='POST'>";
	desplegable_tractaments();
	
	echo"<br>";
	echo"<input type='hidden' name='vedell'  value='".$id_vedell."'>";
	echo"<input type='submit' value='enviar'>";
	
	echo"<form>";
	echo"</table>";
	ContingutFi();
	PFi();
?>
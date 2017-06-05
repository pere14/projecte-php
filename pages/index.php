<?php
	session_start();
    include("fn.php");
	PIni();
	MenuSupIni();
	MenuSupExemple();
	MenuSupFi();
	MenuLatIni();
	if($_SESSION['tipus'] == 1){
		
		MenuLatExempleAdmin();
	}else if($_SESSION['tipus'] == 2){
		
		MenuLatExempleVeterinari();
	}else if($_SESSION['tipus'] == 3){
		
		MenuLatExempleTreballador();
	}
	
	MenuLatFi();
	ContingutIni();
	
	ContingutFi();
	PFi();
?>
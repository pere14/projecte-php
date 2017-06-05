<?php
	session_start();
    include("fn.php");
	PIni();
	MenuSupIni();
	MenuSupExemple();
	MenuSupFi();
	MenuLatIni();
	MenuLatExempleAdmin();
	MenuLatFi();
	ContingutIni();
	/*$connexio=connectar();
	$sql="select descripcio from tractaments";*/
   
   
    echo"<form method='post' action='accio.php?accio=assignar'>";
    echo"<table>";
    echo "<tr>";
    echo "<td>Usuari</td>";
    echo "<td>Cuadra</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>";
	desplegable_usuaris();
	echo "</td>";
	echo"<td>";
	desplegable_quadra(-1);
	echo "</td>";
	echo"<td>";
	echo "</td>";
	echo"<td><input type='submit' name='assignar' value='Assignar'></td>";
	echo "</tr>";
	echo"</table>";
    echo"</form>";

    /*desconnectar($connexio);*/
	
	ContingutFi();
	PFi();
?>
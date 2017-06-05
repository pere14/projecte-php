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
	$connexio=connectar();
?>
<html>
<body>
<?php 
    $missatge="";
    if(isset($_GET['miss']))
    {
        if($_GET['miss']=="1")
        {
           $missatge="<No s'han pogut entrar les dades<br/>";
        }
    }
    echo $missatge;
?>
<form method=post action="accio.php?accio=alta_tractament">
      
	  <h2>Crear el tractament</h2>
	  <table>
	  <tr>
      <td>Descripcio</td>
	  <td><input type="text" name="descripcio"></td>
	  </tr>
	  </table>
	  </br>
	  <input type="submit" name="guardar" value="CREAR">
      
</form>
</body>
</html>
<?php
	ContingutFi();
	PFi();
?>
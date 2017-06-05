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
<form method=post action="accio.php?accio=alta_quadra">
      
      <?php
	  echo "<label>Seleccioneu la granja:</label>";
         desplegable_granja(-1);
      ?>
      <br />
	  <table>
	  <tr>
      <td>Nom de la Quadra:</td>
	  <td><input type="text" name="nom"></td>
	  </tr>
	  <tr>
	  <td> Descripcio de la Quadra:</td>
	  <td><input type="text" name="descripcio"></td>
	  </tr>
	  </table>
      <input type="submit" name="guardar" value="guardar">
</form>
</body>
</html>
<?php
	ContingutFi();
	PFi();
?>
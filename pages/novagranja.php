<?php
    include("fn.php");
	PIni();
	MenuSupIni();
	MenuSupFi();
	MenuLatIni();
	MenuLatExempleAdmin();
	MenuLatFi();
	ContingutIni();
?>
<html>
<body>
<?php 
    $missatge="";
    if(isset($_GET['miss']))
    {
        if($_GET['miss']=="1")
        {
           $missatge="No s'han pogut entrar les dades<br/>";
        }
    }
    echo $missatge;

?>
<form method=post action="accio.php?accio=alta_granja">
      Nom:<input type="text" name="nom"> <br />
      Localitzacio:<input type="text" name="loca"> <br />
      <input type="submit" name="guardar" value="guardar">
</form>
</body>
</html>
<?php
	ContingutFi();
	PFi();
?>
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
<a href=index.php>Inici</a><br />
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
    //include("fn.php");
?>
<form method=post action="accio.php?accio=alta_vedell">
      
      <?php 
         desplegable_quadra(-1);
      ?>
      <br />
      
      Codi Vedell:<input type="text" name="codi"> <br />
      Estat:Sa<input type="radio" name="estat" value="S" checked > Malalt<input type="radio" name="estat" value="M"> <br />
      <input type="submit" name="guardar" value="guardar">
</form>
</body>
</html>
<?php
	ContingutFi();
	PFi();
?>
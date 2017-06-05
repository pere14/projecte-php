<?php
    /*if(!isset($_GET['id']))
    {
       header("Location: quadra.php");
    }*/
    include("fn.php");
	PIni();
	MenuSupIni();
	MenuSupExemple();
	MenuSupFi();
	MenuLatIni();
	MenuLatExempleAdmin();
	MenuLatFi();
	ContingutIni();
    $ide=$_GET['id'];
    $connexio=connectar();
    $sql="select * from quadres where id=".$ide;
    if($resultat=$connexio->query($sql))
    {
        if($fila=mysqli_fetch_array($resultat))
        {
            $nom=$fila[1];
			$descripcio=$fila[2];
            $granja=$fila[3];
            desconnectar($connexio);
        }
        else
        {
            desconnectar($connexio);
            header("Location: quadra.php");
        }
    }
    else
    {
        desconnectar($connexio);
        header("Location: quadra.php");
    }
    


?>
<html>
<body>
<?php
$missatge="";
    if(isset($_GET['miss']))
    {
        if($_GET['miss']=="1")
        {
           $missatge="No s'ha pogut guardar la modificacio<br/>";
        }
    }
    echo $missatge;

?>
<form method=post action="accio.php?accio=modificar_quadra">
      <input type="hidden" name="id" value="<?php echo $ide;?>">
      <?php 
      echo "Seleccioneu la granja";
	  desplegable_granja($granja);
      ?>
      <br />
      Nom:<input type="text" name="nom" value="<?php echo $nom;?>"> <br />
	  Descripcio:<input type="text" name="descripcio" value="<?php echo $descripcio;?>" > <br />
      <input type="submit" name="guardar" value="guardar">
</form>
</body>
</html>
<?php
	ContingutFi();
	PFi();
?>
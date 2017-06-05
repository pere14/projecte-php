<?php
    /*if(!isset($_GET['id']))
    {
       header("Location: granja.php");
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
    $sql="select * from granges where id=".$ide;
    if($resultat=$connexio->query($sql))
    {
        if($fila=mysqli_fetch_array($resultat))
        {
            $nom=$fila[1];
            $localitzacio=$fila[2];
            desconnectar($connexio);
        }
        else
        {
            desconnectar($connexio);
            header("Location: granja.php");
        }
    }
    else
    {
        desconnectar($connexio);
        header("Location: granja.php");
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
<form method=post action="accio.php?accio=modificar_granja">
      <input type="hidden" name="id" value="<?php echo $ide ;?>">
      Nom:<input type="text" name="nom" value="<?php echo $nom; ?> "> <br />
      Localitzacio:<input type="text" name="localitzacio" value="<?php echo $localitzacio;?>"> <br />
      <input type="submit" name="guardar" value="guardar">
</form>
</body>
</html>
<?php
	ContingutFi();
	PFi();
?>
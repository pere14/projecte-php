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
	/*session_start();
    if(!isset($_GET['id']))
    {
       header("Location: quadra.php");
    }*/
    $id=$_GET['id'];
    $connexio=connectar();
    $sql="select * from vedells where codi=".$id;
    if($resultat=$connexio->query($sql))
    {
        if($fila=mysqli_fetch_array($resultat))
        {
            $estat=$fila[1];
            $quadra=$fila[2];

            if($estat==0)
            {
              $sa="checked";
              $malalt="";
			  $mort="";
			  $venut="";
            } 
            else if($estat==1)
            {
              $sa="";
              $malalt="checked";
			  $mort="";
			  $venut="";
            }
			else if($estat==2)
            {
              $sa="";
              $malalt="";
			  $mort="checked";
			  $venut="";
            }
			else if($estat==3)
            {
              $sa="";
              $malalt="";
			  $mort="";
			  $venut="checked";
            }  			
           
            desconnectar($connexio);
        }
        else
        {
            desconnectar($connexio);
            //header("Location: eroor1.php");
        }
    }
    else
    {
        desconnectar($connexio);
        //header("Location: error2.php");
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
<form method=post action="accio.php?accio=modificar_vedell">
      <input type="hidden" name="id" value="<?php echo $id;?>">
      <?php 
      echo "Elegeix la granja on vols ficar el vedell</br>";
	  desplegable_quadra($quadra);
      ?>
	  <br />
	  <br />
      Estat :</br>Sa<input type="radio" name="estat" value="0" <?php echo $sa;?> > Malalt<input type="radio" name="estat" value="1" <?php echo $malalt;?>> </br> Mort<input type="radio" name="estat" value="2" <?php echo $mort;?>> Venut<input type="radio" name="estat" value="3" <?php echo $venut;?>></br>
      
      
      <input type="submit" name="guardar" value="guardar">
</form>
</body>
</html>
<?php
	ContingutFi();
	PFi();
?>
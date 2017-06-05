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
	$usuari = $_SESSION['usuari'];
	$connexio=connectar();
	$sql="
	SELECT id, nom, localitzacio
	FROM granges";
   
  if($resultat=$connexio->query($sql))
  {
      ?>
      <table class="table">
      <tr><td>Nom</td>
      <td>Localitzacio</td>
	  <td>Modificar</td>
	  <td>Eliminar</td>
      </tr>
      <?php
      while($fila=mysqli_fetch_array($resultat))
      {

          echo "<tr><td>".$fila[1]."</td><td>".$fila[2]."</td>";
          echo '<td><a href="modificargranja.php?id='.$fila[0].'"><img src="images/modificar.png" style="height:20px; width:20px"></a></td>
		  <td><a href="accio.php?accio=eliminar_granja&id='.base64_encode($fila[0]).'"><img src="images/eliminar.png" style="height:20px; width:20px"></a></td>';

          
        }
        echo "</table>";
        
    }
    else
    {
        echo "error a la connexio o consulta";
    }
    desconnectar($connexio);
	
	ContingutFi();
	PFi();
?>
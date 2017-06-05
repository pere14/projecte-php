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
	SELECT id, email, nom, cognom1, cognom2, tipus, actiu 
	FROM usuaris";
   
  if($resultat=$connexio->query($sql))
  {
      ?>

      <table class="table">
      <tr><td>email</td>
      <td>Nom</td>
      <td>Cognom1</td>
      <td>Cognom2</td>
      <td>Tipus</td>
      <td>Actiu</td>
	  <td>Modificar</td>
	  <td>Activar/Desactivar</td>
      </tr>
      <?php
      while($fila=mysqli_fetch_array($resultat))
      {
          
          if($fila[6]==0)$textActiu="Inactiu";
          else if($fila[6]==2)$textActiu="Baixa";
          else if($fila[6]==1)$textActiu="Actiu";
          if($fila[5]==1)$textTipus="Empresari";
          else if($fila[5]==2)$textTipus="Veterinari";
		  else if($fila[5]==3)$textTipus="Treballador";
          echo "<tr><td>".$fila[1]."</td><td>".$fila[2]."</td><td>".$fila[3]."</td><td>".$fila[4]."</td><td>".$textTipus."</td><td>".$textActiu."</td>";
          echo '<td><a href="modificarusu.php?id='.$fila[0].'"><img src="images/modificar.png" style="height:20px; width:20px"></a></td>';

          
          if($fila[6]==0)
          {
          echo '<td><a href="accio.php?accio=activar_usuari&id='.base64_encode($fila[0]).'"><img src="images/activar.png" style="height:20px; width:20px"></a></td>';
          


          //echo "<br />";  
          //echo $fila["id"]."-".$fila["nom"]."-".$fila["localitzacio"]."<br />";
          echo "</tr>";
          //aqui puc accedir als resultats 
          //que he rebut.
          }
          
          if($fila[6]==1)
          {
          echo '<td><a href="accio.php?accio=desactivar_usuari&id='.base64_encode($fila[0]).'"><img src="images/desactivar.png" style="height:20px; width:20px"></a></td>';
          


          //echo "<br />";  
           //echo $fila["id"]."-".$fila["nom"]."-".$fila["localitzacio"]."<br />";
           echo "</tr>";
           //aqui puc accedir als resultats 
           //que he rebut.
          }
          if($fila[6]==2)
          {
          echo '<td><a href="accio.php?accio=activar2_usuari&id='.base64_encode($fila[0]).'"><img src="images/activar.png" style="height:20px; width:20px"></a></td>';
          


          //echo "<br />";  
           //echo $fila["id"]."-".$fila["nom"]."-".$fila["localitzacio"]."<br />";
           echo "</tr>";
           //aqui puc accedir als resultats 
           //que he rebut.
          }
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
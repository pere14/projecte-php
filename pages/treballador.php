
<?php
    session_start();
	include("fn.php");
	PIni();
	MenuSupIni();
	MenuSupExemple();
	MenuSupFi();
	MenuLatIni();
	MenuLatExempleTreballador();
	MenuLatFi();
	ContingutIni();
	$usuari = $_SESSION['usuari'];
	$connexio=connectar();
	$sql="select gr.nom, gr.localitzacio, 
            qu.id, qu.nom, ve.* 
            from granges gr, quadres qu, vedells ve
            where qu.id_granja=gr.id and ve.id_quadra=qu.id 
            ORDER BY gr.nom, qu.nom";
   
  if($resultat=$connexio->query($sql))
  {
      ?>
	  <h1>Llistat vedells</h1>
	  <br>
      <table class="table">
	  <td>Granja</td>
	  <td>Quadra</td>
	  <td>Codi Vedell</td>
	  <td>Estat</td>
	  <td>Malalt</td>
	  <td>Mort</td>
	  <td>Venut</td>
      </tr>
      <?php
	  
	  
	  
      while($fila=mysqli_fetch_array($resultat))
      {
          
          if($fila[5]==0)$textEstat="Sa";
          else if($fila[5]==1)$textEstat="Malalt";
		  else if($fila[5]==2)$textEstat="Mort";
		  else if($fila[5]==3)$textEstat="Venut";
          echo "<tr><td>".$fila[0]."</td><td>".$fila[3]."</td><td>".$fila[4]."</td><td>".$textEstat."</td>";
          echo '<td><a href="accio.php?accio=malalt_vedell&id='.base64_encode($fila[4]).'"><img src="images/activar.png" style="height:20px; width:20px"></a></td>
		  <td><a href="accio.php?accio=mort_vedell&id='.base64_encode($fila[4]).'"><img src="images/mort.png" style="height:20px; width:20px"></a></td>
		  <td><a href="accio.php?accio=venut_vedell&id='.base64_encode($fila[4]).'"><img src="images/venut.png" style="height:20px; width:20px"></a></td>
		  ';
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
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
	$idu=$_SESSION['id'];
	$connexio=connectar();
	$sql="select q.nom, g.nom, v.codi, q.id
	from assignat a, quadres q, granges g, vedells v
	where g.id=q.id_granja AND q.id=a.id_quadra AND
	a.id_treballador=".$idu." AND
	q.id=v.id_quadra AND v.estat=1";
	
	if($resultat=$connexio->query($sql))
	{
		  ?>
		  <h2>Llistat de Vedells Malalts </h2>
		  <table class="table">
		  <tr>
		  <td>Nom Granja</td>
		  <td>Nom Quadra </td>
		  <td>Codi Vedell</td>
		  <td>Aplicar Tractament</td>
		  <td>Curat</td>
		  <td>Mort</td>
		  </tr>
		  <?php
		  while($fila=mysqli_fetch_array($resultat))
		  {
			echo "<tr><td>".$fila[1]."</td><td>".$fila[0]."</td><td>".$fila[2]."</td>";
			echo '<td><a href="aplicarTractament.php?id='.$fila[3].'&id_vedell='.$fila[2].'"><img src="images/modificar.png" style="height:20px; width:20px"></a></td>
			<td><a href="accio.php?accio=curar_vedell&id='.$fila[2].'"><img src="images/activar.png" style="height:20px; width:20px"></a></td>
			<td><a href="accio.php?accio=matar_vedell&id='.$fila[2].'"><img src="images/desactivar.png" style="height:20px; width:20px"></a></td>';
			
		  }
	}
	else
	{
		echo "error a la connexio o consulta";
	}	

    desconnectar($connexio);
	
	ContingutFi();
	PFi();
?>
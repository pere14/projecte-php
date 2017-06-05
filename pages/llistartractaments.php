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
	$sql="select q.nom, g.nom, v.codi, t.descripcio, tv.data_inici
	from tractament_vedell tv, tractaments t, quadres q, 
	granges g, vedells v
	where g.id=q.id_granja AND q.id=v.id_quadra AND
	tv.id_treballador=".$idu." AND tv.id_vedell=v.codi
	AND tv.id_tractament=t.id
	ORDER BY tv.data_inici";
	
	if($resultat=$connexio->query($sql))
	{
		  
		  ?>
		  <h2>Llistat de Tractaments (Historic)</h2>
		  <table class="table">
		  <tr>
		  <td>Nom Granja</td>
		  <td>Nom Quadra </td>
		  <td>Codi Vedell</td>
		  <td>Descripcio Tractaments</td>
		  <td>Data Inici del Tractament</td>
		  </tr>
		  <?php
		  while($fila=mysqli_fetch_array($resultat))
		  {
			echo "<tr><td>".$fila[1]."</td><td>".$fila[0]."</td><td>".$fila[2]."</td><td>".$fila[3]."</td><td>".$fila[4]."</td>";
			
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
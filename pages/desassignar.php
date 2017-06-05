<?php
    include("fn.php");
	PIni();
	MenuSupIni();
	MenuSupExemple();
	MenuSupFi();
	MenuLatIni();
	MenuLatExempleAdmin();
	MenuLatFi();
	ContingutIni();
	$connexio=connectar();
	$sql="select u.nom, u.cognom1, u.cognom2, u.tipus, q.nom, g.nom, a.id,  a.actiu
	from usuaris u, assignat a, quadres q, granges g
	where g.id=q.id_granja and q.id=a.id_quadra and a.id_treballador=u.id and a.actiu <> 0";
   
	if($resultat=$connexio->query($sql))
	{
		  ?>
		  <table class="table">
		  <tr>
		  <td>Nom Granja</td>
		  <td>Nom Quadra </td>
		  <td>Nom Usuari </td>
		  <td>Cognom1 Usuari </td>
		  <td>Cognom2 Usuari </td>
		  <td>Tipus </td>
		  <td>Actiu </td>
		  <td>Desassignar </td>
		  </tr>
		  <?php
		  while($fila=mysqli_fetch_array($resultat))
		  {
			
			if($fila[7]==0)$textActiu="No Assignat";
			else if($fila[7]==1)$textActiu="Assignat";
			if($fila[3]==1)$textTipus="Empresari";
            else if($fila[3]==2)$textTipus="Veterinari";
		    else if($fila[3]==3)$textTipus="Treballador";
			echo "<tr><td>".$fila[5]."</td><td>".$fila[4]."</td><td>".$fila[2]."</td><td>".$fila[1]."</td><td>".$fila[0]."</td><td>".$textTipus."</td><td>".$textActiu."</td>";
			echo '<td><a href="accio.php?accio=desassignar&id='.$fila[6].'"><img src="images/modificar.png" style="height:20px; width:20px"></a></td>';
          
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
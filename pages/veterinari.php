<?php
    include("fn.php");
	PIni();
	MenuSupIni();
	MenuSupExemple();
	MenuSupFi();
	MenuLatIni();
	MenuLatExempleVeterinari();
	MenuLatFi();
	ContingutIni();
	$connexio=connectar();
	$sql="select descripcio from tractaments";
   
  if($resultat=$connexio->query($sql))
  {
      ?>
	  <h2>Llistat de Tractaments </h2>
      <table class="table">
      <tr><td>Descripcio </td>
      </tr>
      <?php
      while($fila=mysqli_fetch_array($resultat))
      {
          
          echo "<tr><td>".$fila[0]."</td>";
          
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
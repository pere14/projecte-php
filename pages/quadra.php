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
    $missatge="";
    if(isset($_GET['miss']))
    {
        if($_GET['miss']=="1")
        {
           $missatge="S'ha d'eliminar els vedells avans d'eliminar la cuadra<br/>";
        }
        elseif($_GET['miss']=="2")
        {
           $missatge="Dades modificades correctament<br/>";
        }
        elseif($_GET['miss']=="3")
        {
           $missatge="Dades eliminades correctament<br/>";
        }
        elseif($_GET['miss']=="4")
        {
           $missatge="Error a l'eliminar<br/>";
        }
    }
    echo $missatge;    
    $connexio=connectar();
    $sql="select gr.nom, gr.localitzacio, 
            qu.id, qu.nom ,qu.descripcio 
            from granges gr, quadres qu
            where qu.id_granja=gr.id ";
    
    if($resultat=$connexio->query($sql))
    {
?>	
		<h2>Llistat de Quadres amb les seves respectives Granges</h1>
		<table class="table">
		<tr>
		<td>Nom Granja</td>
		<td>Localitzacio</td>
		<td>Nom Quadra</td>
		<td>Descripcio de la Quadra</td>
		<td>Modificar</td>
		<td>Eliminar</td>
		</tr>
		
<?php
        while($fila=mysqli_fetch_array($resultat))
        {
           echo "<tr><td>".$fila[0]."</td><td>".$fila[1]."</td><td>".$fila[3]."</td><td>".$fila[4]."</td>";
           echo '<td><a href="modificarquadra.php?id='.$fila[2].'"><img src="images/modificar.png" style="height:20px; width:20px"></a></td>
		   <td><a href="accio.php?accio=eliminar_quadra&id='.base64_encode($fila[2]).'"><img src="images/eliminar.png" style="height:20px; width:20px"></a>';
        }
           //echo $fila["id"]."-".$fila["nom"]."-".$fila["localitzacio"]."<br />";
           
           //aqui puc accedir als resultats 
           //que he rebut.  
    }
    else
    {
        echo "error a la connexio o consulta";
    }
    desconnectar($connexio);
   	ContingutFi();
	PFi();
?>
<script>
	function crearSelect()
	{	   
	var id = document.getElementById('id').value;
		var xmlhttp=null;
			
			if (window.XMLHttpRequest){
				xmlhttp=new XMLHttpRequest();
			}else{
			 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function(){
			  if (xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("container").innerHTML=xmlhttp.responseText;
				}
			}
			
			xmlhttp.open('GET','accio.php?accio=cercaAvansada&id='+id,true);
			xmlhttp.send();
	}
	</script>
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
	$sql="select gr.nom, gr.localitzacio, 
            qu.id, qu.nom, ve.* 
            from granges gr, quadres qu, vedells ve
            where qu.id_granja=gr.id and ve.id_quadra=qu.id 
            ORDER BY gr.nom, qu.nom";
   
  if($resultat=$connexio->query($sql))
  {
      ?>
	  <h1>Cerca personalitzada de vedells</h1>
		<br>
	  	 <div class="input-group custom-search-form">
		 <form action="vedells.php?accio=llista" method="POST">
		 <label>Introdueix el codi del vedell que vols consultar</label>
         <input type="text" name="id" id="id" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                  <button class="btn btn-default" type="button" onClick="crearSelect()">
						<i class="fa fa-search"></i>
                  </button>
              </span>
		 </form>
	  </div>
	  
	  
	  <br>
	  <div id="container" name="seleccionat">

	  </div>
	  <div class="container">
    <div class="row">
        <div class="col-xs-12"></div>
		 <br>
	  <br>
	  
	  <h1>Llistat vedells</h1>
	  <br>
      <table class="table">
	  <td>Granja</td>
	  <td>Quadra</td>
	  <td>Codi Vedell</td>
	  <td>Estat</td>
	  <td>Sa</td>
	  <td>Malalt</td>
	  <td>Venut</td>
	  <td>Modificar</td>
	  <td>Eliminar</td>
      </tr>
      <?php
	  
	  
	  
      while($fila=mysqli_fetch_array($resultat))
      {
          
          if($fila[5]==0)$textEstat="Sa";
          else if($fila[5]==1)$textEstat="Malalt";
		  else if($fila[5]==2)$textEstat="Mort";
		  else if($fila[5]==3)$textEstat="Venut";
          echo "<tr><td>".$fila[0]."</td><td>".$fila[3]."</td><td>".$fila[4]."</td><td>".$textEstat."</td>";
		            echo '<td><a href="accio.php?accio=sa_vedell&id='.base64_encode($fila[4]).'"><img src="images/activar.png" style="height:20px; width:20px"></a></td>
		  <td><a href="accio.php?accio=malalt_vedell&id='.base64_encode($fila[4]).'"><img src="images/mort.png" style="height:20px; width:20px"></a></td>
		  <td><a href="accio.php?accio=venut_vedell&id='.base64_encode($fila[4]).'"><img src="images/venut.png" style="height:20px; width:20px"></a></td>
		  ';
          echo '<td><a href="modificarvedell.php?id='.$fila[4].'"><img src="images/modificar.png" style="height:20px; width:20px"></a></td>
		  <td><a href="accio.php?accio=eliminar_vedell&id='.base64_encode($fila[0]).'"><img src="images/eliminar.png" style="height:20px; width:20px"></a>';
		  
        }
        echo "</table>";
        
    }
    else
    {
        echo "error a la connexio o consulta";
    }
    echo"</div>";
echo"</div>";
	 
    desconnectar($connexio);
	
	ContingutFi();
	PFi();
?>
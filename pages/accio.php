<?php
	session_start();


	include("fn.php");
    if(!isset($_GET['accio']))
    {
        header("Location: index.php");
    }
    $accio=$_GET['accio'];
    if($accio=="login_usuari")
    {
	//echo "hola";
    //compravar que el usuari no esta repetit a la base de dades
    $nom=$_POST["usuari"];
    $pasw=$_POST["password"];
    $sql="
    SELECT id, email, nom, cognom1, cognom2, tipus, actiu  
    FROM usuaris
    WHERE nom='$nom' AND password = '$pasw'";
    $connexio=connectar();
    if($resultat=$connexio->query($sql))
	{
		//echo "hola";
        if($fila=mysqli_fetch_array($resultat)) 
		{
        	if($fila[6]==0)
        	{
        		//error s'ha d'activar el usuari
                desconnectar($connexio);
                header("Location: login.php?miss=1");
        	}

        	else
        	{
				//echo "hola";
        		//creem les variables de sessio de id, nom del usuari, cognom1, cognom2, tipus
        		$ide=$fila[0];
        		$_SESSION['id']=$ide;
        		$usu=$fila[2];
        		$_SESSION['usuari']=$usu;
        		$cognom1=$fila[3];
        		$_SESSION['cognom1']=$cognom1;
				$cognom2=$fila[4];
				$_SESSION['cognom2']=$cognom2;
				$tipus=$fila[5];
				$_SESSION['tipus']=$tipus;
        		if($fila[5]==1)
        		{
        			desconnectar($connexio);
        			header ("Location: empresari.php");
        			//redireccionar empresari
        		}
        		else if($fila[5]==2)
        		{
        			desconnectar($connexio);
        			header ("Location: veterinari.php");
        			//redireccionar treballador
        		}
				else if($fila[5]==3)
        		{
        			desconnectar($connexio);
        			header ("Location: treballador.php");
        			//redireccionar treballador
        		}
        	}
        }
        else
        {
            //usuari o contrasenya introduits incorrectament
            desconnectar($connexio);
            header("Location: login.php?miss=2");
        }
    }
    else
    {
        //error execucio de la consulta
		desconnectar($connexio);
        header("Location: login.php?miss=3");
    }    
}

	else if($accio=="alta_usuari")
    {
    	//agafo els valors que m'ha introduit el usuari per poderlos comprabar amb la base de dades
    	$nom=$_POST['usuari'];
		if($_POST['tipus']==1)
		{
			$tipus=3;
		}
		else
		{
			$tipus=2;
		}
		
		$email=$_POST['email'];
		$cognom1=$_POST['cognom1'];
		$cognom2=$_POST['cognom2'];
    	$pasw=$_POST['password'];
		
    	//faig la consulta amb la base de dades per poder donar de alta el usuari
    	$sql="
    	SELECT id, email, nom, cognom1, cognom2, tipus
		FROM usuaris
		WHERE nom =  '$nom'";

		//echo $sql
		//echo "hola";
		$connexio=connectar();
		if($resultat=$connexio->query($sql))
        {

        	if($fila=mysqli_fetch_array($resultat))
        	{
        		//echo "Usuari duplicat";
        		desconnectar($connexio);
            	header("Location: registre.php?miss=1");
        	}
        	else 
        	{
				//echo "hola";
        		//desconnectar($connexio);
        		$sql="INSERT into usuaris values('dummy','".$pasw."','".$email."','".$nom."','".$cognom1."','".$cognom2."','".$tipus."','0')";
        		if($connexio->query($sql))
          		{
          			
					$sql1="SELECT MAX(id)
					FROM usuaris";
					//2,El passo al header com passo el nrondes
					if($resultat=$connexio->query($sql1))
					{
						if($fila=mysqli_fetch_array($resultat))
						{
							//echo "El usuari s'ha registrat correctament";
							desconnectar($connexio);
							header("Location: empresari.php");
						}
						else
						{
							desconnectar($connexio);
							header("Location: empresari.php?miss=1");
						}
							
					}
         		}
        		else
          		{
					//error en la sentencia insert
             		desconnectar($connexio);
             		header("Location: empresari.php?miss=2");
          		}
        	}
        }
        else
        {
            desconnectar($connexio);
            header("Location: empresari.php?miss=2");
        }
    }

	else if($accio=="activar_usuari")
    {
        //activem el usuari (de 0 a 1)
        $ide=base64_decode($_GET["id"]);
        $sql="update usuaris set actiu='1' where id=".$ide;
        $connexio=connectar();
        if($connexio->query($sql))
        {
            desconnectar($connexio);
            header("Location: empresari.php");
        }
        else
        {
            desconnectar($connexio);
            header("Location: empresari.php?miss=1&id=".$ide);
        }
    }
    else if($accio=="activar2_usuari")
    {
        //activem el usuari (de 2 a 1)
        $ide=base64_decode($_GET["id"]);
        $sql="update usuaris set actiu='1' where id=".$ide;
        $connexio=connectar();
        if($connexio->query($sql))
        {
            desconnectar($connexio);
            header("Location: empresari.php");
        }
        else
        {
            desconnectar($connexio);
            header("Location: empresari.php?miss=1&id=".$ide);
        }
    }
	else if($accio=="desactivar_usuari")
    {
        
        //desactivem el usuari (de 1 a 2)
        $ide=base64_decode($_GET["id"]);
        $sql="update usuaris set actiu='2' where id=".$ide;
        $connexio=connectar();
        if($connexio->query($sql))
        {
            desconnectar($connexio);
            header("Location: empresari.php");
        }
        else
        {
            desconnectar($connexio);
            header("Location: empresari.php?miss=1&id=".$ide);
        }
    }
	else if($accio=="modificar_password")
    {
        $ide=$_POST["id"];
        $paswm=$_POST["passwm"];
        $paswm1=$_POST['passwm1'];
        if($paswm==$paswm1)
        {
            $pasw=$paswm1;
            $sql="update usuaris set password='".$pasw."'where id= '".$ide."';";
            $connexio=connectar();
            if($resultat=$connexio->query($sql))
            {
                desconnectar($connexio);
                header("Location: empresari.php");

            }
            else
            {
                desconnectar($connexio);
                header("Location: modificarusu.php?miss=1&id=".$ide);
            }
        }
        else
        {
            desconnectar($connexio);
            header("Location: modificarusu.php?miss=2&id=".$ide);
        }
    }
	else if($accio=="alta_granja")
    {
         //agafo els valors que m'ha introduit el usuari per poderlos comprabar amb la base de dades
    	$nom=$_POST['nom'];
		$localitzacio=$_POST['localitzacio'];
		
		
    	//faig la consulta amb la base de dades per poder donar de alta el usuari
    	$sql="
    	SELECT id, nom, localitzacio
		FROM granges
		WHERE nom =  '$nom'";

		//echo $sql
		//echo "hola";
		$connexio=connectar();
		if($resultat=$connexio->query($sql))
        {

        	if($fila=mysqli_fetch_array($resultat))
        	{
        		//echo "quadra duplicat";
        		desconnectar($connexio);
            	header("Location: novagranja.php?miss=1");
        	}
        	else 
        	{
				//echo "hola";
        		//desconnectar($connexio);
        		$sql="INSERT into granjes values('dummy','".$nom."','".$localitzacio."')";
        		if($connexio->query($sql))
          		{
          			
					$sql1="SELECT MAX(id)
					FROM granges";
					//2,El passo al header com passo el nrondes
					if($resultat=$connexio->query($sql1))
					{
						if($fila=mysqli_fetch_array($resultat))
						{
							//echo "La quadra se insertat correctament";
							desconnectar($connexio);
							header("Location: novagranja.php");
						}
						else
						{
							//error a la base de dades
							desconnectar($connexio);
							header("Location: novagranja.php?miss=2");
						}	
					}
         		}
        		else
          		{
					//error en la sentencia insert
             		desconnectar($connexio);
             		header("Location: novagranja.php?miss=3");
          		}
        	}
        }
        else
        {
			//error amb la sentencia select
            desconnectar($connexio);
            header("Location: novagranja.php?miss=4");
        }
    }
	elseif($accio=="modificar_granja")
     {
          //insert granja
          $ide=$_POST["id"];
          $nom=$_POST["nom"];
          $localitzacio=$_POST["localitzacio"];
          $sql="update granja set nom='".$nom."', localitzacio='".$localitzacio."' where id=".$ide;
          $connexio=connectar();
          if($connexio->query($sql))
          {
             desconnectar($connexio);
             header("Location: granja.php?miss=2");
          }
          else
          {
             desconnectar($connexio);
             header("Location: modificargranja.php?miss=1&id=".$ide);
          }
          
          
          
          
     }
	elseif($accio=="eliminar_granja")
    {
          //delete granja
          $id=base64_decode($_GET["id"]);
		  $sql1="SELECT id FROM quadres WHERE id_granja = '".$id."' ";
          $sql2="delete from granges where id=".$id;
          $connexio=connectar();
		  
		  
		  if($connexio->query($sql1))
          {
			  //La graja te cuadres i s'han de eliminar primer
             desconnectar($connexio);
             header("Location: granja.php?miss=1");
          }
          else
          {
				//No te cuadres i es pot eliminar
							  
			  if($connexio->query($sql2))
			  {
				 desconnectar($connexio);
				 header("Location: granja.php?miss=3");
			  }
			  else
			  {
				 desconnectar($connexio);
				 header("Location: granja.php?miss=4");
			  }
          }
	
          
          
          
	}
	elseif($accio=="eliminar_quadra")
    {
          //delete quadra
          $id=base64_decode($_GET["id"]);
		  $sql1="SELECT codi FROM vedells WHERE id_quadra = '".$id."' ";
          $sql2="delete from quadres where id=".$id;
          $connexio=connectar();
		  
		  
		  if($connexio->query($sql1))
          {
			  if($resultat=$connexio->query($sql1))
					{
						if($fila=mysqli_fetch_array($resultat))
						{
							//La quadra te vedells i s'ha de eliminar el vedell
							desconnectar($connexio);
							header("Location: quadra.php?miss=1");
							
						}else{
							
								 if($connexio->query($sql2))
								  {
									 desconnectar($connexio);
									 header("Location: quadra.php?miss=3");
								  }
								  else
								  {
									 desconnectar($connexio);
									 header("Location: quadra.php?miss=4");
								  }
			
						}
					}
							//No te cuadres i es pot eliminar
		  }
   
	}
	else if($accio=="alta_quadra")
    {
    	//agafo els valors que m'ha introduit el usuari per poderlos comprabar amb la base de dades
    	$nom=$_POST['nom'];
		$descripcio=$_POST['descripcio'];
		$granja=$_POST["granja"];
		
		
    	//faig la consulta amb la base de dades per poder donar de alta el usuari
    	$sql="
    	SELECT id, nom, descripcio, id_granja
		FROM quadres
		WHERE nom =  '$nom'";

		//echo $sql
		//echo "hola";
		$connexio=connectar();
		if($resultat=$connexio->query($sql))
        {

        	if($fila=mysqli_fetch_array($resultat))
        	{
        		//echo "quadra duplicat";
        		desconnectar($connexio);
            	header("Location: novaquadra.php?miss=1");
        	}
        	else 
        	{
				//echo "hola";
        		//desconnectar($connexio);
        		$sql="INSERT into quadres values('dummy','".$nom."','".$descripcio."','".$granja."')";
        		if($connexio->query($sql))
          		{
						desconnectar($connexio);
						header("Location: novaquadra.php");
				}
				else
				{
					//error a la base de dades
					desconnectar($connexio);
					header("Location: novaquadra.php?miss=2");
				}	
        	}
        }
        else
        {
			//error amb la sentencia select
            desconnectar($connexio);
            header("Location: novaquadra.php?miss=4");
        }
    }
	elseif($accio=="modificar_quadra")
     {
          //insert granja
          $ide=$_POST["id"];
          $nom=$_POST["nom"];
		  $descripcio=$_POST["descripcio"];
          $granja=$_POST["granja"];
          
          $sql="update quadres set nom='".$nom."',descripcio='".$descripcio."', id_granja=".$granja." where id=".$ide;
          $connexio=connectar();
          if($connexio->query($sql))
          {
             desconnectar($connexio);
             header("Location: quadra.php?miss=2");
          }
          else
          {
             desconnectar($connexio);
             header("Location: modificarquadra.php?miss=1&id=".$ide);
          }
          
   
     }
	else if($accio=="alta_vedell")
    {
    	//agafo els valors que m'ha introduit el vedell per poderlos comprabar amb la base de dades
    	$codi=$_POST['codi'];
		$estat=$_POST["estat"];
		$quadra=$_POST['quadra'];
		if($estat=='M')
		{
			$estat=1;
		}
		else
		{
			$estat=0;
		}
    	//faig la consulta amb la base de dades per poder donar de alta el vedell
    	$sql="
    	SELECT codi, estat, id_quadra
		FROM vedells
		WHERE codi =  '".$codi."'";

		//echo $sql;
		//echo "hola";
		$connexio=connectar();
		if($resultat=$connexio->query($sql))
        {

        	if($fila=mysqli_fetch_array($resultat))
        	{
        		//echo "vedell duplicat";
        		desconnectar($connexio);
            	header("Location: novavedells.php?miss=1");
        	}
        	else 
        	{
				//echo "hola";
        		desconnectar($connexio);
        		$sql="INSERT into vedells values(".$codi.",'".$estat."',".$quadra.")";
				$connexio=connectar();
        		if($connexio->query($sql))
          		{
					desconnectar($connexio);
					header("Location: novavedells.php");
				}
				else
				{
					//error a la base de dades
					desconnectar($connexio);
					header("Location: novavedells.php?miss=2");
				}	
        	}
        }
        else
        {
			//error amb la sentencia select
            desconnectar($connexio);
            header("Location: novavedells.php?miss=4");
        }
    }
	elseif($accio=="modificar_vedell")
     {
          //insert granja
          $id=$_POST["id"];
          $estat=$_POST["estat"];
          $quadra=$_POST["quadra"];
          $sql="update vedells set estat='".$estat."', id_quadra=".$quadra." where codi=".$id;
          $connexio=connectar();
          //echo $sql;
          if($connexio->query($sql))
          {
             desconnectar($connexio);
             header("Location: vedells.php?miss=2");
          }
          else
          {
             desconnectar($connexio);
             header("Location: modificarvedell.php?miss=1&id=".$id);
          }
          
          
          
          
     }
	
	else if($accio=="cercaAvansada") {
		$id = $_GET['id'];
		$link = mysql_connect('localhost', 'root', 'usbw') or die('Error: ' . mysql_error());

		mysql_select_db('projecte') or die('Error al seleccionar la base de dades');
		mysql_set_charset('utf8', $link);
		$query = 'select gr.nom, gr.localitzacio, 
            qu.id, qu.nom, ve.* 
            from granges gr, quadres qu, vedells ve
            where qu.id_granja=gr.id and ve.id_quadra=qu.id';
		
		if($id!="")
		{
		$query= $query.' AND ve.codi = "'.$id.'"';
		}
		$query .= ' ORDER BY gr.nom, qu.nom';
		$result = mysql_query($query) or die('Error: ' . mysql_error());

	echo "<table width='60%' border='1' align='center'>";
		
	echo "<tr>";
	echo "<td width='20%'>Granja</td>";
	echo "<td  width='20%'>Quadra</td>";
	echo "<td  width='20%'>Codi Vedell</td>";
	echo "<td  width='20%'>Estat</td>";
	echo "<td  width='20%'>Modificar</td>";
	echo "<td  width='20%'>Eliminar</td>";
	echo "</tr>";
	while($row = mysql_fetch_array($result)){
		echo "<tr><td>".$row[0]."</td> 
		<td>".$row[3]." </td> 
		<td>".$row[4]."</td>
		<td>".$row[5]."</td> 
		<td><a href='modificarvedell.php?id=".$row[4]."'><img src='images/modificar.png' style='height:20px; width:20px'></a></td>
		<td><a href='accio.php?accio=eliminar_vedell&id=".base64_encode($row[4])."'><img src='images/eliminar.png' style='height:20px; width:20px'></td></tr>";
	}
	echo "</table>";
	}
	else if($accio == "assignar"){
		$connexio = connectar();
		$id_usu = $_POST['usuari'];
		$id_quadra = $_POST['quadra'];
		$sql="INSERT into assignat values('dummy','".$id_usu."','".$id_quadra."', 1)";
		$sql2="SELECT * FROM assignat WHERE id_treballador = '".$id_usu."' AND id_quadra = '".$id_quadra."' ";
		
		
   if($resultat=$connexio->query($sql2))
	{
		//echo "hola";
        if($fila=mysqli_fetch_array($resultat)) 
		{
                desconnectar($connexio);
                header("Location: asignar.php?miss=1");
        
		}else{
			
					
					if($connexio->query($sql))
						  {
							 desconnectar($connexio);
							 header("Location: asignar.php?miss=2");
						  }else{
							  
							 desconnectar($connexio);
							 header("Location: asignar.php?miss=3"); 
						  }	
				
			}	
		

	}
	
	}else if($accio=="desassignar")
	{
		$ide=$_GET['id'];
		$connexio = connectar();
		$sql="update assignat set actiu='0' where id=".$ide;
		if($connexio->query($sql))
        {
			desconnectar($connexio);
			header("Location: desassignar.php");
        }
		else
		{
			desconnectar($connexio);
			header("Location: desassignar.php?miss=1");	  
		}
	}
	else if($accio=="alta_tractament")
    {
         //agafo els valors que m'ha introduit el usuari per poderlos comprabar amb la base de dades
    	$descripcio=$_POST['descripcio'];
		
    	//faig la consulta amb la base de dades per poder donar de alta el usuari
    	$sql="
    	SELECT id, descripcio
		FROM tractaments
		WHERE descripcio =  '$descripcio'";

		//echo $sql
		//echo "hola";
		$connexio=connectar();
		if($resultat=$connexio->query($sql))
        {

        	if($fila=mysqli_fetch_array($resultat))
        	{
        		//echo "tractament duplicat";
        		desconnectar($connexio);
            	header("Location: crearTractament.php?miss=1");
        	}
        	else 
        	{
				//echo "hola";
        		//desconnectar($connexio);
        		$sql="INSERT into tractaments values('dummy','".$descripcio."')";
        		if($connexio->query($sql))
          		{
          			
					$sql1="SELECT MAX(id)
					FROM tractaments";
					//2,El passo al header com passo el nrondes
					if($resultat=$connexio->query($sql1))
					{
						if($fila=mysqli_fetch_array($resultat))
						{
							//echo "El tractament se insertat correctament";
							desconnectar($connexio);
							header("Location: crearTractament.php");
						}
						else
						{
							//error a la base de dades
							desconnectar($connexio);
							header("Location: crearTractament.php?miss=2");
						}	
					}
         		}
        		else
          		{
					//error en la sentencia insert
             		desconnectar($connexio);
             		header("Location: crearTractament.php?miss=3");
          		}
        	}
        }
        else
        {
			//error amb la sentencia select
            desconnectar($connexio);
            header("Location: crearTractament.php?miss=4");
        }
    }
	else if($accio=="curar_vedell")
	{
		$idv=$_GET['id'];
		$sql="update vedells set estat='0' where codi=".$idv;
        $connexio=connectar();
        if($connexio->query($sql))
        {
            desconnectar($connexio);
            header("Location: vedellsmalalts.php");
        }
        else
        {
            desconnectar($connexio);
            header("Location: vedellsmalalts.php?miss=1&id=".$idv);
        }
    }
	else if($accio=="matar_vedell")
	{
		$idv=$_GET['id'];
		$sql="update vedells set estat='2' where codi=".$idv;
        $connexio=connectar();
        if($connexio->query($sql))
        {
            desconnectar($connexio);
            header("Location: vedellsmalalts.php");
        }
        else
        {
            desconnectar($connexio);
            header("Location: vedellsmalalts.php?miss=1&id=".$idv);
        }
	}
	else if($accio == "aplicar_tractament")
	{
    $connexio=connectar();	
	$id_tractament = $_POST['tractament'];
	$id_vedell = $_POST['vedell'];
	
	$sql="INSERT into tractament_vedell values('dummy',".$id_tractament.", ".$id_vedell.",".$_SESSION['id'].", now())";
		if($connexio->query($sql))
        {
            desconnectar($connexio);
            header("Location: llistartractaments.php");
        }
        else
        {
            desconnectar($connexio);
            header("Location: vedellsmalalts.php?miss=1");
        }
		
		
		
		
	}
	else if($accio=="sa_vedell")
    {
        //fiquem el camp estat del vedell a sa (estat=0)
        $ide=base64_decode($_GET["id"]);
        $sql="update vedells set estat='0' where codi=".$ide;
        $connexio=connectar();
        if($connexio->query($sql))
        {
     			if($_SESSION['tipus'] == 1){
				
			desconnectar($connexio);
            header("Location: vedells.php");
			}else if($_SESSION['tipus'] == 2){
            desconnectar($connexio);
            header("Location: veterinari.php");
			}else if($_SESSION['tipus'] == 3){
	            desconnectar($connexio);
				header("Location: treballador.php");
			}
			
        }
        else
        {
            desconnectar($connexio);
            header("Location: treballador.php?miss=1&id=".$ide);
        }
    }
	else if($accio=="malalt_vedell")
    {
        //fiquem el camp estat del vedell a malalt (estat=1)
        $ide=base64_decode($_GET["id"]);
        $sql="update vedells set estat='1' where codi=".$ide;
        $connexio=connectar();
        if($connexio->query($sql))
        {
			
			if($_SESSION['tipus'] == 1){
				
			desconnectar($connexio);
            header("Location: vedells.php");
			}else if($_SESSION['tipus'] == 2){
            desconnectar($connexio);
            header("Location: veterinari.php");
			}else if($_SESSION['tipus'] == 3){
	            desconnectar($connexio);
				header("Location: treballador.php");
			}
		}
        else
        {
            desconnectar($connexio);
            header("Location: treballador.php?miss=1&id=".$ide);
        }
    }
	else if($accio=="mort_vedell")
    {
        //fiquem el camp estat del vedell a mort (estat=2)
        $ide=base64_decode($_GET["id"]);
        $sql="update vedells set estat='2' where codi=".$ide;
        $connexio=connectar();
        if($connexio->query($sql))
        {
			if($_SESSION['tipus'] == 1){
				
			desconnectar($connexio);
            header("Location: vedells.php");
			}else if($_SESSION['tipus'] == 2){
            desconnectar($connexio);
            header("Location: veterinari.php");
			}else if($_SESSION['tipus'] == 3){
	            desconnectar($connexio);
				header("Location: treballador.php");
			}
        }
        else
        {
            desconnectar($connexio);
            header("Location: treballador.php?miss=1&id=".$ide);
        }
    }
	else if($accio=="venut_vedell")
    {
        //fiquem el camp estat del vedell a venut (estat=3)
        $ide=base64_decode($_GET["id"]);
        $sql="update vedells set estat='3' where codi=".$ide;
        $connexio=connectar();
        if($connexio->query($sql))
        {
			if($_SESSION['tipus'] == 1){
				
			desconnectar($connexio);
            header("Location: vedells.php");
			}else if($_SESSION['tipus'] == 2){
            desconnectar($connexio);
            header("Location: veterinari.php");
			}else if($_SESSION['tipus'] == 3){
	            desconnectar($connexio);
				header("Location: treballador.php");
			}
        }
        else
        {
            desconnectar($connexio);
            header("Location: treballador.php?miss=1&id=".$ide);
        }
    }
	
	
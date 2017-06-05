<?php
    include("fn.php");
	PIni();
	MenuSupIni();
	MenuSupExemple();
	MenuSupFi();
	MenuLatIni();
	MenuLatExemple();
	MenuLatFi();
	ContingutIni();
?>
	<table>
	<form action="procesa.php?accio=editar_password" method="POST">
	<tr><td>Contraseña</td>
	<input type="hidden" name="id" value="<?php echo $ide ?>">
	<td><input type="password" name="passwm"><br/></td>
	</tr>
	<tr><td>Repetir contraseña</td>
	<td><input type="password" name="passwm1"><br/></td>
	</tr>
	<tr>
	<td><input type="submit" value="Confirmar"></td>
	</tr>
	</form>
	</table>
	
<?php
	//aquest control ha de ser amb javascript
	if(isset($_GET['miss']))
    {
		if($_GET['miss']=="2")
		{
		   $missatge="Les contrasenyes no coincideixen<br/>";
		   echo "<script>alert('Les contrasenyes no coincideixen');</script>";
		}
		elseif($_GET['miss']=="1")
		{
		   $missatge="Error al acces a la base de dades<br/>";
		   echo "<script>alert('Error al acces a la base de dades');</script>";
		}
		//echo $missatge;
    } 
	ContingutFi();
	PFi();
?>
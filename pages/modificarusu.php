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
	$ide = $_GET['id']; // agafem la id que ens pasem del usuari el qual volem cambiar les seves dades
	?>
	<table>
	<form action="accio.php?accio=modificar_password" method="POST">
	<tr><td>Contraseña</td>
	<input type="hidden" name="id" value="<?php echo $ide ?>">
	<td><input type="password" name="passwm"><br/></td>
	</tr>
	<tr><td>Repetir contraseña</td>
	<td><input type="password" name="passwm1"><br/></td>
	</tr>
	<tr><td>Email</td>
	<td><input type="text" name="email"><br/></td>
	</tr>
	<tr>
	<td><input type="submit" value="Confirmar"></td>
	</tr>
	</form>
	</table>
	<?php
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
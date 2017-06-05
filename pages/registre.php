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
	$connexio=connectar();
	$sql = "SELECT tipus FROM usuaris WHERE id = '".$_SESSION['id']."' AND tipus <> '1'";
?>
<table class="table">
	<h1> Formulari del REGISTRE <h1>
	<form action="accio.php?accio=alta_usuari" enctype="multipart/form-data" method="POST">
	<tr><td>Nom</td>
	<td><input type="text" name="usuari"><br/></td>
	</tr>
	<tr><td>Tipus</td>
	<td>
<?php 	
	echo"<select name = 'tipus'>";
	echo"<option value = '1'>Treballador</option>";
	echo"<option value = '2'>Veterinari</option>";
	echo"</select>" 
?>
	</td>
	</tr>
	<tr><td>Cognom1</td>
	<td><input type="text" name="cognom1"><br/></td>
	</tr>
	<tr><td>Cognom2</td>
	<td><input type="text" name="cognom2"><br/></td>
	</tr>
	<tr><td>Email</td>
	<td><input type="text" name="email"><br/></td>
	</tr>
	<tr><td>Contraseña</td>
	<td><input type="password" name="password"><br/></td>
	</tr>
	<td><input type="submit" class="btn btn-success" value="REGISTER"></td>
	</form>
</table>

<?php
	ContingutFi();
	PFi();
?>
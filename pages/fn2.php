<?php
function connectar ()
{
	$connect=mysqli_connect("localhost","root","usbw","projecte");
	$connect->query("SET NAMES 'utf8'");
	return $connect;
}
       
function desconnectar ($connect)
{
	mysqli_close($connect);
}
function desplegable_vedells($codivedells)
{
    $connexio=connectar();
    $sql="select gr.localitzacio, ga.id,ga.numero, gr.nom 
	from granja gr, gabia ga 
	where gr.id=ga.id_granja 
	order by gr.nom, ga.numero";
    echo '<select name="gabia">';
    if($resultat=$connexio->query($sql))
    {
        while($fila=mysqli_fetch_array($resultat))
        {
           if($fila[0]==$codiGabia)
           {
              echo '<option value="'.$fila[0].'" selected >'.$fila[2].'-'.$fila[1].'</option>';
           }
           else
           {
               echo '<option value="'.$fila[0].'">'.$fila[2].'-'.$fila[1].'</option>';
           }
        }
        
    }
    else
    {
        echo "error a la connexio o consulta";
    }
    echo '</select>';
    desconnectar($connexio);

}
?>
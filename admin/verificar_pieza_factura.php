<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){	
if(isset($_POST['codigo_pieza'])){
if(isset($_POST['cantidad'])){
$rand=rand();
$clase='btn btn-block btn-danger elim';
$codigo=filtroxss($_POST['codigo_pieza']);
$cantidad=filtroxss($_POST['cantidad']);
if (($codigo=="") || ($cantidad=="") ) {
	echo negativo("Debes ingresar los campos requeridos");
	exit;
}
$consulta=("SELECT * FROM pieza WHERE codigo_pieza='$codigo' AND habilitado=0 LIMIT 1");
$sd=cons($consulta);
if(mysqli_num_rows($sd)>=1){
while($row=mysqli_fetch_array($sd)){
$id_rango=$row['id_rango'];
$nombre=$row['nombre'];
$codigo_pieza=$row['codigo_pieza'];
$id_pieza=$row['id_pieza'];
$cols=("SELECT * FROM inventario WHERE id_pieza='$id_pieza' LIMIT 1");
$g=cons($cols);
while($gv=mysqli_fetch_array($g)){
	$precio=$gv['precio'];
}
$cant=cantidad($id_pieza);
if($cantidad>$cant){
echo negativo("No hay cantidad suficiente. Cantidad actual es ".$cant."");
	exit;
}
$var="a".$rand;
$v2="c".$rand;
$tabla="<tr class=".$var."><td><input type=".'hidden'." value=".$id_pieza." name=".'id_pieza[]'."><input class=".$v2." value=".$codigo." type=".'hidden'." name=".'codigo_pieza[]'.">".$codigo."</td><td>".$nombre."</td><td><input class=".$v2." type=".'text'." value=".$precio." name=".'precio[]'."></td><td><input class=".$v2." type=".'hidden'." value=".$cantidad." name=".'cantidad[]'.">".$cantidad."</td><td><button type=".'button'." ps=".$rand." class=".'elimform-control'." >Eliminar</button></td></tr>";

?>
<script>
$('#la_tabla tr:last').after('<?php echo $tabla;?>');
$("#aparecer").show();
</script>
<?php

}


}else{
echo negativo("La pieza no existe en el sistema");
	exit;	
}

}
}
}
?>
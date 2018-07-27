<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_proveedor'])){
$id_proveedor=strtoupper(filtroxss($_POST['id_proveedor']));
if($id_proveedor==""){
echo negativo("Uno de los campos del vehiculo est&aacute;n vacio. Intentalo nuevamente");
exit;	
}
$upd=("UPDATE proveedor SET habilitado=1 WHERE id_proveedor='$id_proveedor'");
cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error General. Intentalo nuevamente!");
exit;	
}else{
$consulta=("SELECT * FROM proveedor WHERE id_proveedor='$id_proveedor' LIMIT 1");
$f=cons($consulta);	
while($row=mysqli_fetch_array($f)){
    $nombre=$row['nombre'];
}
echo positivo("Se ha Eliminado el proveedor ".$nombre." exitosamente!");
}
?>
<script>
function redireccionar(){window.location="proveedores.php";} 
setTimeout ("redireccionar()", 4000);
</script>
<?php
}
}
?>
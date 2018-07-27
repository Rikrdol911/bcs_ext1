<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_cliente'])){
$id_proveedor=strtoupper(filtroxss($_POST['id_cliente']));
if($id_proveedor==""){
echo negativo("Uno de los campos del vehiculo est&aacute;n vacio. Intentalo nuevamente");
exit;	
}
$upd=("UPDATE cliente SET habilitado=1 WHERE id_cliente='$id_proveedor'");
cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error General. Intentalo nuevamente222!");
exit;	
}else{
$consulta=("SELECT * FROM cliente WHERE id_cliente='$id_proveedor' LIMIT 1");
$f=cons($consulta);	
while($row=mysqli_fetch_array($f)){
    $nombre=$row['nombre'];
}
echo positivo("Se ha Eliminado el Cliente ".$nombre." exitosamente!");
}
?>
<script>
function redireccionar(){window.location="registrar_cliente.php";} 
setTimeout ("redireccionar()", 4000);
</script>
<?php
}
}
?>
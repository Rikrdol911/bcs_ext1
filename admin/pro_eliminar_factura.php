<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['facconf'])){
if(isset($_POST['fecha'])){
if(isset($_POST['id_proveedor'])){
if(isset($_POST['n_factura'])){
$n_factura=strtoupper(filtroxss($_POST['n_factura']));
$facconf=strtoupper(filtroxss($_POST['facconf']));
$id_proveedor=filtroxss($_POST['id_proveedor']);
$fecha=filtroxss($_POST['fecha']);
if($n_factura==""){
echo negativo("Uno de los campos est&aacute; vacio. Intentalo nuevamente");
exit;	
}
if ($n_factura!=$facconf) {
echo negativo("El N fact. no corresponde. Intentalo nuevamente");
exit;	
}else{
$upd=("UPDATE inventario SET habilitado=1 WHERE n_factura='$n_factura' AND id_proveedor='$id_proveedor' AND fecha='$fecha'");
cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error General. Intentalo nuevamente!");
exit;	
}else{
echo positivo("Se ha Eliminado la factura ".$n_factura." exitosamente!");
}
?>
<script>
function redireccionar(){window.location="inventario.php";} 
setTimeout ("redireccionar()", 4000);
</script>
<?php
}
}
}
}
}
}
?>
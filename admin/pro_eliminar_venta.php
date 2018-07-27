<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['ventacof'])){
if(isset($_POST['id_factura'])){
$n_venta=strtoupper(filtroxss($_POST['id_factura']));
$ventacof=strtoupper(filtroxss($_POST['ventacof']));
if($n_venta==""){
echo negativo("Uno de los campos est&aacute; vacio. Intentalo nuevamente");
exit;	
}
if ($n_venta!=$ventacof) {
echo negativo("El N de Venta no corresponde. Intentalo nuevamente");
exit;	
}else{
$upd=("UPDATE factura SET habilitado=1 WHERE id_factura='$n_venta'");
cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error General. Intentalo nuevamente!");
exit;	
}
else{
echo positivo("Se ha Eliminado la factura ".$n_venta." exitosamente!");
}
?>
<script>
function redireccionar(){window.location="ver_facturar.php";} 
setTimeout ("redireccionar()", 4000);
</script>
<?php
}
}
}
}
?>
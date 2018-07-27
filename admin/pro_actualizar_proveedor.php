	<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['rif'])){
if(isset($_POST['telefono'])){
if(isset($_POST['direccion'])){
if(isset($_POST['correo'])){
if(isset($_POST['nombre'])){
if(isset($_POST['observacion'])){	
if(isset($_POST['id'])){
if(isset($_POST['tipo'])){
if(is_numeric($_POST['id'])){	
$nrif=filtroxss($_POST['rif']);
$ntipo=filtroxss($_POST['tipo']);
$ntelefono=filtroxss($_POST['telefono']);
$ndireccion=strtoupper(filtroxss($_POST['direccion']));
$nobservacion=strtoupper(filtroxss($_POST['observacion']));
$ncorreo=strtoupper(filtroxss($_POST['correo']));
$nnombre=strtoupper(filtroxss($_POST['nombre']));
$id_proveedor=filtroxss($_POST['id']);
if(($nrif=="") || ($ntelefono=="") || ($ndireccion=="") || ($ncorreo=="") || ($nnombre=="") || ($ntipo=="")|| ($id_proveedor=="")){
	echo negativo("Uno de los campos esta vacio. Intentalo nuevamente!");
exit;	
}
$consulta=("SELECT * FROM proveedor WHERE id_proveedor='$id_proveedor' AND habilitado=0 LIMIT 1");
$d=cons($consulta);
if(mysqli_num_rows($d)<=0){
echo negativo("El proveedor no esta registrado.");
exit;	
}
$upd=("UPDATE proveedor SET id_tipo='$ntipo',rif='$nrif',telf='$ntelefono',direccion='$ndireccion',observacion='$nobservacion',correo='$ncorreo',nombre='$nnombre' WHERE id_proveedor='$id_proveedor' AND habilitado=0 LIMIT 1");	
$d=cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error general, Intentalo nuevamente");	
}else{
echo positivo("Se han actualizado los datos de ".$nnombre."");
}
}
}
}
}
}
}
}
}
}
}
?>
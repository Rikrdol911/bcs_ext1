<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_pieza'])){
if(isset($_POST['nid_rango'])){
if(isset($_POST['ncodigo_pieza'])){
if(isset($_POST['nnombre_pieza'])){
$id_pieza=filtroxss($_POST['id_pieza']);
$id_rango=filtroxss($_POST['nid_rango']);
$nombre_pieza=strtoupper(filtroxss($_POST['nnombre_pieza']));	
$codigo_pieza=filtroxss($_POST['ncodigo_pieza']);
if(($nombre_pieza=="") || ($id_rango=="") || ($nombre_pieza=="") || ($codigo_pieza=="")){
	echo negativo("Uno de los campos esta vacio. Intentalo nuevamente!");
exit;	
}
$consulta=("SELECT * FROM pieza WHERE id_pieza='$id_pieza' AND habilitado=0 LIMIT 1");
$d=cons($consulta);
if(mysqli_num_rows($d)<=0){
echo negativo("La pieza no esta registrada.");
exit;	
}
$upd=("UPDATE pieza SET id_rango='$id_rango',nombre='$nombre_pieza',codigo_pieza='$codigo_pieza' WHERE id_pieza='$id_pieza' AND habilitado=0 LIMIT 1");	
$d=cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error general, Intentalo nuevamente");	
}else{
echo positivo("Se han actualizado los datos de ".$nombre_pieza."");
}
}
}
}
}
}
?>
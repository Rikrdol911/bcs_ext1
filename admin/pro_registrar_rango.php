<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['nombre_rango'])){
$nombre_rango=filtroxss(strtoupper($_POST['nombre_rango']));
if($nombre_rango==""){
	echo negativo("Uno de los campos esta vacio. Intentalo nuevamente!");
exit;	
}
$insr=("INSERT INTO rango (nombre,habilitado)
VALUES ('$nombre_rango',0)");
cons($insr);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Hubo un error general, intentalo nuevamente");	
}else{
echo positivo("Has registrado el Rango: ".$nombre_rango." exitosamente.");
}
}
}
?>
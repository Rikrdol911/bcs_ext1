<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['dni'])){
$dni=filtroxss($_POST['dni']);
$tipo=filtroxss($_POST['tipo']);
if(isset($_POST['fecha'])){
if(isset($_POST['n_factura'])){
$fecha=filtroxss($_POST['fecha']);
$n_factura=filtroxss($_POST['n_factura']);	
if (($fecha=="") || ($n_factura=="")|| ($tipo=="")) {
		echo negativo("Debes ingresar los datos correspondientes");
		exit;
}
foreach(array_values(array_unique($_POST['codigo_pieza'])) as $v) {
($verificar1=array_diff ($_POST['codigo_pieza'], array_diff($_POST['codigo_pieza'], array_diff_key($_POST['codigo_pieza'], array_unique($_POST['codigo_pieza'])))));
}
if (!empty($verificar1)) {
 	echo negativo ("Existen C&oacute;digos Repetidos ");
 	exit;
} 
$consulta=("SELECT * FROM proveedor WHERE rif='$dni' AND id_tipo='$tipo' AND habilitado=0 LIMIT 1");
$d=cons($consulta);
if(mysqli_num_rows($d)<=0){
	if(isset($_POST['nombre'])){
	if(isset($_POST['telefono'])){
	if(isset($_POST['direccion'])){
	if(isset($_POST['correo'])){
	$nombre=filtroxss($_POST['nombre']);
	$telefono=filtroxss($_POST['telefono']);
	$direccion=filtroxss($_POST['direccion']);
	$correo=filtroxss($_POST['correo']);
	$observacion=filtroxss($_POST['observacion']);
		$ins=("INSERT INTO proveedor (id_tipo,rif,nombre,telf,direccion,correo,observacion,habilitado)
		VALUES ('$tipo','$dni','$nombre','$telefono','$direccion','$correo','$observacion',0)");
		cons($ins);
		if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
		echo negativo("Hubo un error registrando el proveedor intentalo nuevamente");
		exit;	
		}else{
			$id_proveedor=mysqli_insert_id($_SESSION['conexion_database']);
		}
	
	}
	}
	}
	}
}else{
	while($fg=mysqli_fetch_array($d)){
	$id_proveedor=$fg['id_proveedor'];	
	}
	
}
$consultaprobar=("SELECT * FROM inventario WHERE n_factura='$n_factura' AND id_proveedor='$id_proveedor' AND habilitado=0 LIMIT 1");
$compro=cons($consultaprobar);
if (mysqli_num_rows($compro)>=1) {
	echo negativo("La facutra ya se encuentra registrada");
	exit;
	}
if (isset($_POST['taller'])) {
foreach($_POST['codigo_pieza'] as $numero => $valor){
echo $codigo_pieza=$valor;
$nombre_pieza=$_POST['nombre_pieza'][$numero];
if (strpos($codigo_pieza, " ")){
    echo negativo ("Error. La cadena contiene espacios vacíos.");
exit;
}
$id_rango=$_POST['id_rango'][$numero];
$precio=$_POST['precio'][$numero];
$cantidad=$_POST['cantidad'][$numero];
$habilitado=3;
if ($nombre_pieza=$nombre_pieza) {
	echo negativo("Existe una Pieza Duplicada");
	exit;
}
$consul=("SELECT * FROM pieza WHERE codigo_pieza='$codigo_pieza' AND habilitado='$habilitado'");
$vf=cons($consul);
if(mysqli_num_rows($vf)<=0){
$is=("INSERT INTO pieza (id_rango,nombre,codigo_pieza,habilitado) 
VALUES ('$id_rango','$nombre_pieza','$codigo_pieza','$habilitado')");
cons($is);
$id_pieza=mysqli_insert_id($_SESSION['conexion_database']);	
}else{
	while($rv=mysqli_fetch_array($vf)){
		$id_pieza=$rv['id_pieza'];
	}
}

$inr=("INSERT INTO inventario (id_pieza,id_proveedor,fecha,n_factura,cantidad,precio,habilitado)
VALUES ('$id_pieza','$id_proveedor','$fecha','$n_factura','$cantidad','$precio','$habilitado')");
cons($inr);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error registrando pieza con codigo: ".$codigo_pieza."".print_r($_POST['codigo_pieza'])."");		
}else{
echo positivo("Ingreso exitoso al inventario pieza: ".$codigo_pieza."");
}	
}	
}else{
foreach($_POST['codigo_pieza'] as $numero => $valor){
$codigo_pieza=$valor;
$nombre_pieza=$_POST['nombre_pieza'][$numero];
$id_rango=$_POST['id_rango'][$numero];
$precio=$_POST['precio'][$numero];
$cantidad=$_POST['cantidad'][$numero];
$habilitado=0;
$consul=("SELECT * FROM pieza WHERE codigo_pieza='$codigo_pieza' AND habilitado='$habilitado'");
$vf=cons($consul);
if(mysqli_num_rows($vf)<=0){
$is=("INSERT INTO pieza (id_rango,nombre,codigo_pieza,habilitado) 
VALUES ('$id_rango','$nombre_pieza','$codigo_pieza','$habilitado')");
cons($is);
$id_pieza=mysqli_insert_id($_SESSION['conexion_database']);	
}else{
	while($rv=mysqli_fetch_array($vf)){
		$id_pieza=$rv['id_pieza'];
	}
}

$inr=("INSERT INTO inventario (id_pieza,id_proveedor,fecha,n_factura,cantidad,precio,habilitado)
VALUES ('$id_pieza','$id_proveedor','$fecha','$n_factura','$cantidad','$precio','$habilitado')");
cons($inr);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error registrando pieza con codigo: ".$codigo_pieza."".print_r($_POST['codigo_pieza'])."");		
}else{
echo positivo("Ingreso exitoso al inventario pieza: ".$codigo_pieza."");
}	
}
}

}
}
}
}
?>
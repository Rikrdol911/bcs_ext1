<?php $conectar=TRUE; include("conexion.php");
if (ini_get('max_execution_time') < 120) {
    set_time_limit(350);
}

if(isset($_SESSION['ingreso'])){
if(isset($_POST['tipo'])){	
if(isset($_POST['dni'])){
if(is_numeric($_POST['dni'])){	
if(isset($_POST['iva'])){
if(isset($_POST['flete'])){
if(isset($_POST['fecha'])){
$iva=filtroxss($_POST['iva']);	
$id_tipo=filtroxss($_POST['tipo']);
$dni=filtroxss($_POST['dni']);
$flete=filtroxss($_POST['flete']);
$fecha=filtroxss($_POST['fecha']);
$consulta=("SELECT * FROM cliente WHERE id_tipo='$id_tipo' AND dni='$dni' AND habilitado=0 LIMIT 1");
$f=cons($consulta);
if(mysqli_num_rows($f)<=0){

if(isset($_POST['telefono'])){	
if(isset($_POST['direccion'])){
if(isset($_POST['correo'])){
if(isset($_POST['nombre'])){

	$telefono=filtroxss($_POST['telefono']);
	$direccion=strtoupper(filtroxss($_POST['direccion']));
	$correo=strtoupper(filtroxss($_POST['correo']));
	$nombre=strtoupper(filtroxss($_POST['nombre']));
	if(($id_tipo=="") || ($dni=="") || ($telefono=="") || ($direccion=="") || ($nombre=="") || ($iva=="") || ($flete=="")){
	echo negativo("Uno de los campos del registro de cliente esta vacio. Intentalo nuevamente!");
    exit;	
}
$imagenes=array();
include('class.upload.php');
$destino = 'documentos';
if(isset($_FILES['cedula'])){
if($_FILES['cedula']['name']!=""){	
if(!$sep=explode('image/',$_FILES["cedula"]["type"])){
echo negativo("El archivo no es permitido");
exit;
}
$tipos=$sep[1];
$tamano = $_FILES [ 'cedula' ][ 'size' ]; // Leemos el tamaño del fichero 
$tamaño_max="6000000"; 
if( ($tamano > $tamaño_max)){
echo negativo("Error, el tama&ntilde;o de la imagen supera el permitido");
	exit;	
}
if(($tipos != "jpeg" && $tipos != "jpg" && $tipos!="png" )){
echo negativo("Tipo de imagen incorrecta");
	exit;		
}
$j=microtime(sha1(sha1(md5(rand(9999948,100)))));
$nombre1=sha1($j);
$nombre11=$nombre1.".jpg";
$pic1 = $_FILES['cedula'];
array_push($imagenes,$nombre11);
	$foo = new Upload($pic1);	
if ($foo->uploaded) {
  // save uploaded image with a new name
  $foo->file_new_name_body = $nombre1;
  $foo->image_resize = true;
  $foo->image_convert = 'jpg';
  $foo->image_x = 600;
  $foo->image_ratio_y = true;
  $foo->Process($destino);
if ($foo->processed) {
   $foo->Clean();
  } 
}


}
}

if(isset($_FILES['carnet'])){
if($_FILES['carnet']['name']!=""){	
if(!$sep=explode('image/',$_FILES["carnet"]["type"])){
echo negativo("El archivo no es permitido");
exit;
}
$tipos=$sep[1];
$tamano = $_FILES [ 'carnet' ][ 'size' ]; // Leemos el tamaño del fichero 
$tamaño_max="6000000"; 
if( ($tamano > $tamaño_max)){
echo negativo("Error, el tama&ntilde;o de la imagen supera el permitido");
	exit;	
}
if(($tipos != "jpeg" && $tipos != "jpg" && $tipos!="png" )){
echo negativo("Tipo de imagen incorrecta");
	exit;		
}
$j=microtime(sha1(sha1(md5(rand(9999948,100)))));
$nombre2=sha1($j);
$nombre22=$nombre2.".jpg";
$pic1 = $_FILES['carnet'];
array_push($imagenes,$nombre22);
	$foo1 = new Upload($pic1);	
if ($foo1->uploaded) {
  // save uploaded image with a new name
  $foo1->file_new_name_body = $nombre2;
  $foo1->image_resize = true;
  $foo1->image_convert = 'jpg';
  $foo1->image_x = 600;
  $foo1->image_ratio_y = true;
  $foo1->Process($destino);
if ($foo1->processed) {
   $foo1->Clean();
  } 
}
}
}
$arr=serialize($imagenes);

$insr=("INSERT INTO cliente (id_tipo,dni,nombre,telf,direccion,correo,images,habilitado)
VALUES ('$id_tipo','$dni','$nombre','$telefono','$direccion','$correo','$arr',0)");
cons($insr);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Hubo un error general registrando al cliente, intentalo nuevamente");
exit;	
}else{
echo positivo("Has registrado el cliente: ".$nombre." exitosamente.");
$id_cliente=mysqli_insert_id($_SESSION['conexion_database']);
}

}else{
	echo negativo("El cliente no esta registrado, debes indicar todos los campos");
exit;
}
}else{
	echo negativo("El cliente no esta registrado, debes indicar todos los campos");
exit;
}
}else{
	echo negativo("El cliente no esta registrado, debes indicar todos los campos");
exit;
}
}else{
	echo negativo("El cliente no esta registrado, debes indicar todos los campos 4");
exit;
}
}else{
//el cliente si esta registrado
while($tg=mysqli_fetch_array($f)){
$id_cliente=$tg['id_cliente'];	
}	
}



$id_pieza=$_POST['id_pieza'];
$array_pieza=array();
$array_precio=array();
$array_cantidad=array();
foreach($id_pieza as $num=>$id){
$llave=array_search($id, $array_pieza);

if(!is_numeric($llave)){
array_push($array_pieza,$id);
array_push($array_precio,$_POST['precio'][$num]);
array_push($array_cantidad,$_POST['cantidad'][$num]);
}else{
$array_cantidad[$llave]=$array_cantidad[$llave]+$_POST['cantidad'][$num];
}
}

foreach($array_pieza as $num=>$id){
$lac=cantidad($id);
 $solicita=$array_cantidad[$num];
if($solicita>$lac){
	$consl=("SELECT * FROM pieza WHERE id_pieza='$id' LIMIT 1");
	$d=cons($consl);
	while($fd=mysqli_fetch_array($d)){
		$nombre_pieza=$fd['nombre'];
	}
	echo negativo("No hay cantidad suficiente para ".$nombre_pieza." Cantidad disponible (".$lac.")");
	exit;
}


}
//se agrega un valor 0 demás luego del habilitado para la impesión
if ($id_tipo==11) {
	$ml=0;
}else{
	$ml=1;
}
echo $ml;
$ins=("INSERT INTO factura (id_cliente,fecha,iva,flete,ml,habilitado,imp)
	VALUES ('$id_cliente','$fecha','$iva','$flete','$ml',0,0)");
cons($ins);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
	echo negativo("Error general, intentalo nuevamente");
exit;
}else{
$id_factura=mysqli_insert_id($_SESSION['conexion_database']);
}

foreach($array_pieza as $num=>$id){
	$monto=$array_precio[$num];
	$cantidad=$array_cantidad[$num];
	$upd=("UPDATE inventario SET precio='$monto' WHERE id_pieza='$id' LIMIT 1");
	cons($upd);
$ins=("INSERT INTO detalle_factura (id_factura,id_pieza,cantidad,monto)
	VALUES ('$id_factura','$id','$cantidad','$monto')");
cons($ins);
}
echo positivo("Factura numero ".$id_factura." creada exitosamente, para imprimir <a href='imprimir_factura.php?id=".$id_factura."'>Clic Aqui</a>");
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
}
}
}
?>
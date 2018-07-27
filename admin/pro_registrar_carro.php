<?php $conectar=TRUE; include("conexion.php");
if (ini_get('max_execution_time') < 120) {
    set_time_limit(350);
}
if(isset($_SESSION['ingreso'])){
if(isset($_POST['tipo'])){	
if(isset($_POST['dni'])){
if(is_numeric($_POST['dni'])){	
$id_tipo=filtroxss($_POST['tipo']);
$dni=filtroxss($_POST['dni']);
$consulta=("SELECT * FROM cliente WHERE id_tipo='$id_tipo' AND dni='$dni' AND habilitado=0 LIMIT 1");
$f=cons($consulta);
if(mysqli_num_rows($f)<=0){
if(isset($_POST['telefono'])){
if(isset($_POST['direccion'])){
if(isset($_POST['correo'])){
if(isset($_POST['nombre'])){
	$telefono=filtroxss($_POST['telefono']);
	$direccion=strtoupper(filtroxss($_POST['direccion']));
	$correo=filtroxss($_POST['correo']);
	$nombre=filtroxss(strtoupper($_POST['nombre']));
	if(($id_tipo=="") || ($dni=="") || ($telefono=="") || ($direccion=="") || ($correo=="") || ($nombre=="")){
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
	echo negativo("El cliente no esta registrado, debes indicar todos los campos1");
	exit;
}
}else{
	echo negativo("El cliente no esta registrado, debes indicar todos los campos2");
	exit;
}
}else{
	echo negativo("El cliente no esta registrado, debes indicar todos los campos3");
}
}else{	
echo negativo("El cliente no esta registrado, debes indicar todos los campos5");
exit;
}


}else{
//AQUI VA SI LA PERSONA SI ESTA REGISTRADA; SOLO SE RESCATAN ALGUNOS DATOS.	
while($tg=mysqli_fetch_array($f)){
$id_cliente=$tg['id_cliente'];	
}	
}

if(isset($_POST['id_marca'])){
if(isset($_POST['vin'])){
if(isset($_POST['modelo'])){
if(isset($_POST['serial_motor'])){
if(isset($_POST['ano'])){
if(isset($_POST['color'])){
if(isset($_POST['placa'])){
if(isset($_POST['cilindro'])){
if(isset($_POST['caja'])){
if(isset($_POST['valvula'])){
if(isset($_POST['nombre_contacto'])){
if(isset($_POST['telefono_contacto'])){
$id_marca=filtroxss($_POST['id_marca']);
$vin=strtoupper(filtroxss($_POST['vin']));
$modelo=strtoupper(filtroxss($_POST['modelo']));
$serial_motor=strtoupper(filtroxss($_POST['serial_motor']));
$ano=strtoupper(filtroxss($_POST['ano']));
$color=strtoupper(filtroxss($_POST['color']));
$placa=strtoupper(filtroxss($_POST['placa']));
$cilindro=strtoupper(filtroxss($_POST['cilindro']));
$caja=strtoupper(filtroxss($_POST['caja']));
$valvula=strtoupper(filtroxss($_POST['valvula']));
$nombre_contacto=strtoupper(filtroxss($_POST['nombre_contacto']));
$telefono_contacto=strtoupper(filtroxss($_POST['telefono_contacto']));

if(($vin=="") || ($modelo=="") || ($color=="") || ($ano=="") || ($placa=="") || ($cilindro=="") || ($caja=="") || ($valvula=="") || ($nombre_contacto=="") || ($telefono_contacto=="")){
echo negativo("Uno de los campos del registro del vehiculo estan vacios. Intentalo nuevamente");
exit;	
}

$consulta=("SELECT * FROM carro WHERE placa='$placa' AND habilitado=0 LIMIT 1");
$dv=cons($consulta);
if(mysqli_num_rows($dv)>=1){
	echo negativo("El vehiculo ya se encuentra registrado en el sistema. Si deseas ver el vehiculo haz <a href='perfil_carro.php?placa=".$placa."'>Clic Aqui (".$placa.")</a>");
exit;	
}else{
	$contact=$nombre_contacto."!#!".$telefono_contacto;
$insert=("INSERT INTO carro (id_marca,id_cliente,vin,modelo,serial_motor,ano,placa,color,cilindro,caja,valvula,contacto,habilitado)
VALUES ('$id_marca','$id_cliente','$vin','$modelo','$serial_motor','$ano','$placa','$color','$cilindro','$caja','$valvula','$contact',0)");
cons($insert);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error General. Intentalo nuevamente!");
exit;	
}else{
echo positivo("Se ha registrado el vehiculo ".$placa." exitosamente!");
?>
<script>
$("#formulario").trigger("reset");
<?php
exit;
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
}
}
}






	
	
	
}
}
}
}
?>
<?php $conectar=TRUE; include("conexion.php");

if(isset($_SESSION['ingreso'])){
if(isset($_POST['tipo'])){
if(isset($_POST['dni'])){
if(is_numeric($_POST['dni'])){
if(isset($_POST['telefono'])){	
if(isset($_POST['direccion'])){
if(isset($_POST['correo'])){
if(isset($_POST['nombre'])){	
if(isset($_POST['id'])){
if(is_numeric($_POST['id'])){	
$tipo=filtroxss($_POST['tipo']);
$dni=filtroxss($_POST['dni']);
$telefono=filtroxss($_POST['telefono']);
$direccion=filtroxss($_POST['direccion']);
$correo=filtroxss($_POST['correo']);
$nombre=filtroxss($_POST['nombre']);
$id_registro=filtroxss($_POST['id']);
if(($tipo=="") || ($dni=="") || ($telefono=="") || ($direccion=="") || ($correo=="") || ($nombre=="") || ($id_registro=="")){
	echo negativo("Uno de los campos esta vacio. Intentalo nuevamente!");
exit;	
}
$consulta=("SELECT * FROM cliente WHERE id_cliente='$id_registro' AND habilitado=0 LIMIT 1");
$d=cons($consulta);
if(mysqli_num_rows($d)<=0){
echo negativo("El cliente no esta registrado.");
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
if(count($arr)==0){
$upd=("UPDATE cliente SET id_tipo='$tipo',dni='$dni',telf='$telefono',direccion='$direccion',correo='$correo',nombre='$nombre' WHERE id_cliente='$id_registro' AND habilitado=0 LIMIT 1");	
}else{
$upd=("UPDATE cliente SET id_tipo='$tipo',dni='$dni',telf='$telefono',direccion='$direccion',correo='$correo',nombre='$nombre',images='$arr' WHERE id_cliente='$id_registro' AND habilitado=0 LIMIT 1");	
}


$d=cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error general, Intentalo nuevamente");	
}else{
echo positivo("Se han actualizado los datos de ".$nombre."");
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
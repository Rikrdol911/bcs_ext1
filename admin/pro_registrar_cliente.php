<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['tipo'])){
if(isset($_POST['dni'])){
if(is_numeric($_POST['dni'])){
if(isset($_POST['telefono'])){
if(isset($_POST['direccion'])){
if(isset($_POST['nombre'])){	
$tipo=filtroxss($_POST['tipo']);
$dni=filtroxss($_POST['dni']);
$telefono=filtroxss($_POST['telefono']);
$direccion=strtoupper(filtroxss($_POST['direccion']));
if(isset($_POST['correo'])){
$correo=strtoupper(filtroxss($_POST['correo']));
}else{
  $correo="";
}
$nombre=filtroxss(strtoupper($_POST['nombre']));
if (ini_get('max_execution_time') < 120) {
    set_time_limit(350);
}
if(($tipo=="") || ($dni=="") || ($telefono=="") || ($direccion=="") || ($nombre=="")){
	echo negativo("Uno de los campos esta vacio. Intentalo nuevamente!");
exit;	
}
$consulta=("SELECT * FROM cliente WHERE id_tipo='$tipo' AND dni='$dni' AND habilitado=0 LIMIT 1");
$d=cons($consulta);
if(mysqli_num_rows($d)>=1){
echo negativo("El cliente ya se encuentra registrado.");
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
 $consult=("SELECT * FROM tipo");
		  $d=cons($consult);
		  $ti=array();
		  while($fg=mysqli_fetch_array($d)){
			  $ti[$fg['id_tipo']]=$fg['nombre'];
		  }
$arr=serialize($imagenes);

$insr=("INSERT INTO cliente (id_tipo,dni,nombre,telf,direccion,correo,images,habilitado)
VALUES ('$tipo','$dni','$nombre','$telefono','$direccion','$correo','$arr',0)");
cons($insr);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Hubo un error general, intentalo nuevamente");	
}else{
echo positivo("Has registrado el cliente: ".$nombre." exitosamente.");
$id=mysqli_insert_id($_SESSION['conexion_database']);
$coq='<tr><td>'.$ti[$tipo].'- '.$dni.'</td><td> <a href="perfil.php?id='.$id.'">'.$nombre.'</a></td><td>'.$telefono.'</td></tr>';
?>
<script>
$("#formulario").trigger("reset");
$('#example1 tr:first').after('<?php echo $coq;?>');
</script>
<?php	
}







}
}
}
}
}
}
}
?>



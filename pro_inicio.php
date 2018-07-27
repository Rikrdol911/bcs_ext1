<?php $conectar=TRUE; include("admin/conexion.php"); ?>


<?php 
if(!isset($_SESSION['ingreso'])){
if(isset($_POST['usuario'])){
if(isset($_POST['clave'])){
$usuario=filtroxss($_POST['usuario']);
$clave=filtroxss($_POST['clave']);
if(($usuario=="") || ($clave=="")){
	echo negativo("Uno de los campos esta vacio, por favor intentalo nuevamente");

exit;	
}
$clave=sha1($clave);
$consulta=("SELECT * FROM admin WHERE usuario='$usuario' AND clave='$clave' AND habilitado=0 LIMIT 1");
$f=cons($consulta);
if(mysqli_num_rows($f)<=0){
echo negativo("Los datos de ingreso no coinciden o no estas registrado");
exit;	
}else{
while($row=mysqli_fetch_array($f)){
$id_registro=$row['id_admin'];
$_SESSION['ingreso']=$id_registro;
$_SESSION['nombre']=$row['nombre'];
echo positivo("Has iniciado sesion exitosamente ".$row['nombre']."");
echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin/index.php">';
	   ?>
<script>
window.location.href = "admin/index.php";
</script>
<?php
}	
}


}
}
}

?>
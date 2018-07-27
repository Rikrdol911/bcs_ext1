<?php $conectar=TRUE; include("conexion.php");
if(isset($_POST['service'])){
$dato=filtroxss($_POST['service']);
if ($codigo_pieza="") {
	exit;
}else{
$consulta=("SELECT * FROM pieza WHERE habilitado=0 AND (codigo_pieza LIKE'%$dato%' OR nombre LIKE '%$dato%')");
$sd=cons($consulta);
if(mysqli_num_rows($sd)<=0){
echo "Sin Resultados";
}else{
while($s=mysqli_fetch_array($sd)){
echo '<p class="bg-warning"><a class="suggest-element" data="'.$s['codigo_pieza'].'" id="'.$s['codigo_pieza'].'">'.$s['codigo_pieza'].'&nbsp;'.$s['nombre'].'</a></p>';
	}
}



}
}
?>
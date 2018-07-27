<?php $conectar=TRUE; include("conexion.php");
if (isset($_POST['dato'])) {
$dato=filtroxss($_POST['dato']);
$nohay=0;
echo '<h5>B&uacute;squeda&nbsp;de:&nbsp;'.$dato.'</h5><table id="buscador" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>Tipo</th>
                  <th>Descripci&oacute;n</th>
				   <th></th>
                  <th></th>
                  <th></th>            			  
                </tr>
                </thead>
                <tbody id="prep">';
$consulta_proveedor=("SELECT * FROM proveedor WHERE habilitado=0 AND (rif LIKE'%$dato%' OR nombre LIKE '%$dato%' OR telf LIKE  '%$dato%')");
$d=cons($consulta_proveedor);
if(mysqli_num_rows($d)<=0){
	$nohay=($nohay+1);
}else{
while($row=mysqli_fetch_array($d)){
$id_tipo=$row['id_tipo'];
$consulta_tipo=("SELECT * FROM tipo WHERE id_tipo='$id_tipo'");
$t=cons($consulta_tipo);
while($rowt1=mysqli_fetch_array($t)){	
echo '<tr><td>Proveedor</td><td>'.$rowt1['nombre'].'-'.$row['rif'].'&nbsp;<a href="perfil_proveedor.php?id='.$row['id_proveedor'].'">&nbsp;'.$row['nombre'].'</a></td><td>'.$row['telf'].'</td><td>'.$row['correo'].'</td></tr>';
}
}
}//else proveedor
//Consulta CLiente
$consulta_cliente=("SELECT * FROM cliente WHERE habilitado=0 AND (dni LIKE '%$dato%' OR nombre LIKE '%$dato%' OR telf LIKE  '%$dato%')");
$c=cons($consulta_cliente);
if(mysqli_num_rows($c)<=0){
	$nohay=($nohay+1);
}else{
while($rowc=mysqli_fetch_array($c)){
$id_tipo=$rowc['id_tipo'];
$consulta_tipo2=("SELECT * FROM tipo WHERE id_tipo='$id_tipo'");
$t2=cons($consulta_tipo2);
while($rowt2=mysqli_fetch_array($t2)){	
echo '<tr><td>Cliente</td><td>'.$rowt2['nombre'].'-'.$rowc['dni'].'&nbsp;<a href="perfil.php?id='.$rowc['id_cliente'].'">'.$rowc['nombre'].'</a></td><td>'.$rowc['telf'].'</td><td>'.$rowc['correo'].'</td></tr>';
}
}
}//Consulta CLiente
//Consulta Pieza
$trozos=explode(" ",$dato); 
   $numero=count($trozos); 
  if ($numero==1) { 
$consulta_pieza=("SELECT * FROM pieza WHERE (nombre LIKE '%$dato%' OR codigo_pieza LIKE '%$dato%' ) AND habilitado=0");
  	}else{
$consulta_pieza=("SELECT * FROM pieza WHERE habilitado=0 AND MATCH(nombre, codigo_pieza) AGAINST('$dato' IN BOOLEAN MODE)");
  	}

$p=cons($consulta_pieza);
if(mysqli_num_rows($p)<=0){
	$nohay=($nohay+1);
}else{
while($rowp=mysqli_fetch_array($p)){
$id_pieza=$rowp['id_pieza'];
$id_rango=$rowp['id_rango'];
$consulta_rango=("SELECT * FROM rango WHERE id_rango='$id_rango'");
$rango=cons($consulta_rango);
while($rowr=mysqli_fetch_array($rango)){	
echo '<tr><td>Pieza</td><td>'.$rowp['codigo_pieza'].'</td><td>'.$rowr['nombre'].'&nbsp;'.$rowp['nombre'].'</td><td>Cantidad:&nbsp;'.cantidad($id_pieza).'</td></tr>';
}
}
}//Consulta Pieza




echo '</tbody></table>';
}else{
echo '<td>Debes Igresar al menos un Dato</td></tbody></table>';
}
if($nohay==5){
	echo alerta("No se encontro resultados");
}
?>
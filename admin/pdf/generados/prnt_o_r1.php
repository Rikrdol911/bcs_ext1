<?php
//Obtener las Variables Necesarias
$id_or=$_POST['id_or'];
$fechahoy=date('d/m/Y');
//end Variables
//Conexion con la bd
$servidor="localhost";
$usuarios="root";
$password="";
$db="bcs";
$conexion=mysqli_connect($servidor,$usuarios,$password) or die("Error conectando...");
mysqli_select_db($conexion,$db) or die("No consigue la base de datos");
$_SESSION['conexion_database']=$conexion;
// end bd

//consulta de la OR
  $consultaor=("SELECT * FROM o_r WHERE id_or='$id_or' AND habilitado=0 LIMIT 1");
  $v1=mysqli_query($_SESSION['conexion_database'],$consultaor) or die(mysqli_error($_SESSION['conexion_database']));
  if(mysqli_num_rows($v1)<=0){
echo negativo("La OR no existe");
    exit;
  }
  while($rf1=mysqli_fetch_array($v1)){
    $id_cliente=$rf1['id_cliente'];
    $fecha_cierre1=$rf1['fecha_cierre'];
    $fechaexplode=explode('-', $fecha_cierre1);
    $fecha_cierre=$fechaexplode[2]."/".$fechaexplode[1]."/".$fechaexplode[0];
$consultacli=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' AND habilitado=0 LIMIT 1"); 
$ds=mysqli_query($_SESSION['conexion_database'],$consultacli) or die(mysqli_error($_SESSION['conexion_database']));
while($g=mysqli_fetch_array($ds)){
$nombre_cliente=$g['nombre'];
$correo=$g['correo'];
$telefono_cliente=$g['telf'];
$direccion_cliente=$g['direccion'];
$id_tipo=$g['id_tipo'];
$dni=$g['dni'];
$consultatipo=("SELECT * FROM tipo WHERE id_tipo='$id_tipo' LIMIT 1"); 
$tp=mysqli_query($_SESSION['conexion_database'],$consultatipo) or die(mysqli_error($_SESSION['conexion_database']));
while($t=mysqli_fetch_array($tp)){
$nombre_tipo=$t['nombre'];
}//cierre while de tipo
}//cierra while de consulta cliente
$id_carro=$rf1['id_carro'];
$consultacarro=("SELECT * FROM carro WHERE id_carro='$id_carro' AND habilitado=0 LIMIT 1");
$d=mysqli_query($_SESSION['conexion_database'],$consultacarro) or die(mysqli_error($_SESSION['conexion_database']));
if(mysqli_num_rows($d)<=0){
echo negativo("No existe el carro");
  exit;
}
while($f=mysqli_fetch_array($d)){
$id_marca=$f['id_marca'];
$modelo=$f['modelo'];
$ano=$f['ano'];
$placa=$f['placa'];
$color=$f['color'];
$cilindro=$f['cilindro'];
$caja=$f['caja'];
$valvula=$f['valvula'];
$vin=$f['vin'];
$consultamarca=("SELECT * FROM marca WHERE id_marca='$id_marca' LIMIT 1");
$m=mysqli_query($_SESSION['conexion_database'],$consultamarca) or die(mysqli_error($_SESSION['conexion_database']));
if(mysqli_num_rows($m)<=0){
echo negativo("No existe la marca");
  exit;
}//if de la marca
while($mm=mysqli_fetch_array($m)){
$nombre_marca=$mm['nombre'];
}//while de la marca
}//cierra wuhile de carro
}//cierra while de consulta OR
?>
<?php
//TOTALES
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' LIMIT 1");
$f=mysqli_query($_SESSION['conexion_database'],$consulta) or die(mysqli_error($_SESSION['conexion_database']));   
$total_or=0;
while($row=mysqli_fetch_array($f)){
  $iva=$row['iva'];
  $km=$row['kilometros'];
  $numero_or=$row['numero_or'];
 $titulo=unserialize($row['array_titulo']);
 $mano_obra=unserialize($row['array_mano_obra']);
  $horas=unserialize($row['array_horas']);
  $precios=unserialize($row['array_precio']);
  $garantia=unserialize($row['array_garantia']);
  foreach($titulo as $numero => $id_mano){
$prec=$precios[$numero];
$garant=$garantia[$numero];
if($garant==0){
  $total_or=($total_or+$prec);
}

  }
}
$total_repuestos=0;
$consu=("SELECT * FROM repuesto_or WHERE id_or='$id_or' AND habilitado=0");
$co=mysqli_query($_SESSION['conexion_database'],$consu) or die(mysqli_error($_SESSION['conexion_database']));   
while($ro=mysqli_fetch_array($co)){
$cant=$ro['cantidad'];
$prec=$ro['precio'];
$taller=$ro['taller'];
if($taller==0){
$total_repuestos=($total_repuestos+($cant*$prec));
}
    }
$total_servicios=0;
$consulta=("SELECT * FROM servicios_or WHERE id_or='$id_or' AND habilitado=0");
$r=mysqli_query($_SESSION['conexion_database'],$consulta) or die(mysqli_error($_SESSION['conexion_database']));   
while($ros=mysqli_fetch_array($r)){
$total_servicios=($total_servicios+$ros['monto']);
    }

$todo=(($total_or+$total_repuestos)+$total_servicios);




?>
<!-- IMPORTANTE: El contenido de la etiqueta style debe estar entre comentarios de HTML -->
<style>
<!--
#tabla_mano {padding:10px; padding-bottom: 15px; border: 1px solid; width:100%;}
#tabla_mano #td1{width:5%;}
#tabla_mano #td2{width:60%;}
#tabla_mano #td3{width:5%;}
#tabla_mano #td4{width:20%;}
#tabla_mano #td5{width:10%;}
.tabla_notas {padding-bottom: 0px; border: 1px solid; width:100%;}
#tabla_pieza{padding:10px; border:1px solid; width:100%;}
.tabla_notas td{width:100%;}
#tabla_pieza #td1{ width:10%;}
#tabla_pieza #td2{ width:39.5%;}
#tabla_pieza #td3{ width:5%;}
#tabla_pieza #td4{ width:20%;}
#tabla_pieza #td5{ width:22.5%;}
#tabla_servicio{padding:10px; border:1px solid; width:100%;}
#tabla_servicio #td1{width:80%;}
#tabla_servicio #td2{width:20%;}
#encabezado {padding:10px 0; border-top: 0px solid; border-bottom: 0px solid; width:100%;}
#encabezado2 {padding:10px 0; border-top: 0px solid; border-bottom: 0px solid; width:100%;}
#encabezado .fila #col_1 {width: 13%}
#encabezado .fila #col_2 {text-align:left; font-size: 10px; width: 27%}
#encabezado .fila #col_2 .span1_1{text-align:left; font-size: 11px;}
#encabezado .fila #col_2 .span2{text-align:center; font-size: 12px;}
#encabezado .fila #col_3 {padding-left:30px;text-align:right; border:1px solid #46d; width:50%}
#encabezado .fila #col_3 .span3{font-size: 15px;}
#encabezado .fila #col_4 {text-align:right;width: 10%}
#encabezado .fila .img1 {width:90%}
#encabezado .fila #col_2 #span1{font-size: 15px;}
#encabezado .fila #col_2 #span2{font-size: 12px; color: #4d9;}
#encabezado2 .otra_fila #otra1 {text-align:center; border-top:1px solid #46d; border-bottom:1px solid #46d; width:100%}
#encabezado2 .otra_fila #otra1 .titulo { font-size: 16px;}
.mano_obra {margin-top:0px; border:1px; width:100%;}
.td_mano {width: 10%;}
.pieza{margin-top:0px; border:1px; width:100%;}
.notas_t{margin-top:0px; border:1px; width:100%;}
.servicio {margin-top:0px; border:1px; width:100%;}
.notas {margin-top:0px; border:1px; width:100%;}
.text-center{text-align:center;}
.fondo_azul{background-color: #6495ED;}
#footer {padding-top:5px 0; border-top: 2px solid #46d; width:100%;}
#footer .fila td {text-align:center; width:100%;}
#footer .fila td span {font-size: 10px; color: #000;}
#totales{bottom:0px;width:10px;text-align: left;}

-->
</style><!-- page define la hoja con los márgenes señalados -->
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" pageset="old">
<!-- Define el header de la hoja -->
 <table id="encabezado">
  <tr class="fila">
                <td id="col_1" >

          <img class="img1" src="generados/head_and_footer/logo_bosch.png">
          
        </td>
                <td id="col_2">
          <strong><span class="span2">BCS</span><br><span class="span2">AUTOMOTRIZ COROMOTO H, C.A</span></strong>
          <br><span class="span1_1">Av. Constituci&oacute;n Oeste Nro.23. Frente al C. C. Los Mangos</span>
          <br><span class="span1_1">Maracay, Estado Aragua</span><br>
          <span class="span1_1">Tel&eacute;fonos: (0243) 246.17.98 / 245.22.71</span><br>
          <span class="span1_1">R.I.F. J-30190956-9</span>
        </td>
                <td id="col_4">
          <strong><span class="span2"> </span></strong>
        </td>
        <td id="col_3">
          <strong><span class="span3"><?php echo "Orden de Reparaci&oacute;n:&nbsp;".$id_or."<br>Fecha:&nbsp;".$fecha_cierre."<br>Cliente:&nbsp;".$nombre_cliente."<br>".$nombre_tipo."-".$dni."<br>Tel&eacute;fono&nbsp;".$telefono_cliente."<br>Correo:&nbsp;".$correo; ?> </span></strong>
        </td>

            </tr>
            </table>
            <table id="encabezado2">
            <tr class="otra_fila"><td id="otra1"><span class="titulo"><?php echo ucwords(strtolower($nombre_marca))."&nbsp;".$modelo."&nbsp;".$ano."&nbsp;".ucwords(strtolower($caja))."&nbsp;".ucwords(strtolower($color))."&nbsp;VIN:&nbsp;".$vin."&nbsp;<b>Placa:&nbsp;".$placa."</b>&nbsp;Km:".number_format($km,0,',','.'); ?></span></td></tr>
</table>
     <page_footer> <!-- Define el footer de la hoja -->
    <table id="footer">
            <tr class="fila">
        <td>
         [[page_cu]]/[[page_nb]]
        </td>
      </tr>
        </table>
    </page_footer>
<?php
  $consultaor2=("SELECT * FROM o_r WHERE id_or='$id_or' AND habilitado=0 LIMIT 1");
  $v2=mysqli_query($_SESSION['conexion_database'],$consultaor2) or die(mysqli_error($_SESSION['conexion_database']));
  if(mysqli_num_rows($v2)<=0){
echo negativo("La OR no existe");
  }else{
while($row=mysqli_fetch_array($v2)){
$titulo=unserialize($row['array_titulo']);
$mano_obra=unserialize($row['array_mano_obra']);
$horas=unserialize($row['array_horas']);
$precios=unserialize($row['array_precio']);
$garantia=unserialize($row['array_garantia']);
if (isset($titulo)) {
if ($titulo!=="") {
?>
<nobreak>
<div class="mano_obra text-center fondo_azul">Mano de Obra</div>
<table id="tabla_mano" class="text-center">
  <tr id="tr_titulos">
    <td id="td1">Codigo</td>
    <td id="td2">Descripcion</td>
    <td id="td3">Horas</td>
    <td id="td4">Monto</td>
    <td id="td5"></td> 
  </tr>
<?php
foreach($titulo as $numero => $id_mano){
$consd=("SELECT * FROM mano_de_obra WHERE id_mano='$id_mano'");
$df=mysqli_query($_SESSION['conexion_database'],$consd) or die(mysqli_error($_SESSION['conexion_database']));
while($fg=mysqli_fetch_array($df)){
$nombre_mano=$fg['nombre']; 
}
echo '<tr id="a'.$id_mano.'">';
echo '<td>'.$id_mano.'</td>';
echo '<td>';
echo $nombre_mano.'<br>';
$la_mano=$mano_obra[$numero];
foreach($la_mano as $nume =>$id_descripcion){
  $cond=("SELECT * FROM descripcion_mano_de_obra WHERE id_descripcion='$id_descripcion' LIMIT 1");
  $a=mysqli_query($_SESSION['conexion_database'],$cond) or die(mysqli_error($_SESSION['conexion_database']));  
     while($fds=mysqli_fetch_array($a)){
echo "&nbsp;&nbsp;&nbsp;-&nbsp;<b>".$fds['nombre']."</b><br>";
} 
  }
echo '</td>';
echo '<td>'.$horas[$numero].'</td>';
echo '<td>'.number_format($precios[$numero],2,",",".").'&nbsp;Bs</td>';
$garant=$garantia[$numero];
if($garant==0){
  echo "<td></td>";
}else{
 echo '<td>Garantia</td>'; 
}
echo '</tr>';
?>
<?php
}
echo '<tr><td></td><td></td><td></td><td><hr boder="1px">'.number_format($total_or,2,",",".").'</td></tr>';
?>
</table>
</nobreak>
<br>
<?php
}//cierre if de titulo no vacio 
}//cierre if si existe la variable
}//cierre while horas precios mano de obra
}//else
$consu=("SELECT * FROM repuesto_or WHERE id_or='$id_or' AND (habilitado=0 OR habilitado=3)");
$p1=mysqli_query($_SESSION['conexion_database'],$consu) or die(mysqli_error($_SESSION['conexion_database']));
if(mysqli_num_rows($p1)<=0){
}else{
?>
<nobreak>
<div class="pieza text-center fondo_azul">Repuestos</div>
<table id="tabla_pieza" class="text-center">
<tr id="tr_titulos">
<td id="td1">C&oacute;digo</td>
<td id="td2">Descripci&oacute;n</td>
<td id="td3">Cantidad</td>
<td id="td4">Precio Unit.</td>
<td id="td5">Monto Bs.</td>
</tr>
<?php
$preciorepuesto=0;
while($ro=mysqli_fetch_array($p1)){
$id_pie=$ro['id_pieza'];
$cant=$ro['cantidad'];
$preciorepuesto=$ro['precio'];
$taller=$ro['taller'];
if($taller==1){
  $prec="Traido Por Cliente";
}else{
  $prec=number_format($preciorepuesto,2,",",".");
}
$cod1=("SELECT * FROM pieza WHERE id_pieza='$id_pie' LIMIT 1");
$p2=mysqli_query($_SESSION['conexion_database'],$cod1) or die(mysqli_error($_SESSION['conexion_database']));
while($f=mysqli_fetch_array($p2)){
echo '<tr id="tr_des">
      <td class="codigo_pieza"><b>'.$f['codigo_pieza'].'</b></td>
      <td class="nombre_pieza">'.$f['nombre'].'</td>
      <td class="cantidad"><b>'.$cant.'</b></td>
      <td class="precio">'.$prec.'</td>

';
if($taller==0){
echo '<td>'.number_format(($cant*$preciorepuesto),2,",",".").'&nbsp;Bs</td>';
}else{
echo '<td>Traido. Clie</td>';
}
echo "</tr><tr><td></td></tr>";
}//while nombre de pieza
}//while pieza1
echo '
<tr><td></td><td></td><td></td><td></td><td><hr border="1px">'.number_format($total_repuestos,2,",",".").'&nbsp;Bs</td></tr>';
?>
</table>
</nobreak>
<br>
<?php
}//else de pieza
?>

<?php
$consultaservicios=("SELECT * FROM servicios_or WHERE id_or='$id_or' AND habilitado=0");
$se=mysqli_query($_SESSION['conexion_database'],$consultaservicios) or die(mysqli_error($_SESSION['conexion_database']));
if(mysqli_num_rows($se)<=0){ 
}else{
?>
<nobreak>
<div class="servicio text-center fondo_azul">Servicios</div>
<table id="tabla_servicio" class="text-center">
<tr id="tr_titulos"> 
<td id="td1">Descripci&oacute;n</td> 
<td id="td2">Monto</td> 
</tr>
<?php
while($ros=mysqli_fetch_array($se)){
echo '<tr>
      <td>'.$ros['descripcion'].'</td>
      <td>'.number_format($ros['monto'],2,",",".").'&nbsp;Bs</td>
      </tr>';
}//while servicios
echo '<tr><td></td><td><hr boder="1px">'.number_format($total_servicios,2,",",".").'&nbsp;Bs</td></tr>';
?>
</table>
</nobreak>
<br>
<?php
}
$consultanotas=("SELECT * FROM o_r WHERE id_or='$id_or' LIMIT 1");
$dno=mysqli_query($_SESSION['conexion_database'],$consultanotas) or die(mysqli_error($_SESSION['conexion_database']));            
if(mysqli_num_rows($d)<=0){ 
}else{
while($ronota=mysqli_fetch_array($dno)){
$notas=$ronota['notas'];
if ($notas!="") {
?>
<div class="notas text-center fondo_azul">Notas</div>
<table class="tabla_notas notas_t">
<tr>
<?php
echo '<td>'.$notas.'</td>';
?>
</tr>
</table>
<?php
}
}
}//else 
echo '
<nobreak>
<div id="totales" border="1px">
<h3>
<table id="tabla_totales">
<tr>
<td>Sub-Total :</td><td>'.number_format($todo,2,",",".").'&nbsp;Bs</td>
</tr>
<tr>
<td>IVA&nbsp;'.$iva.'%:</td><td>'.number_format((($todo*$iva)/100),2,",",".").'&nbsp;Bs</td>
</tr>
<tr>
<td><hr border="1px"></td><td><hr border="1px"></td>
</tr>
<tr>
<td>Total:</td><td>'.number_format(($todo+(($todo*$iva)/100)),2,",",".").'&nbsp;Bs</td>
</tr>
</table>
</h3>
</div>
</nobreak>';
?>

</page>
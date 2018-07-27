<?php session_start();
//Obtener las Variables Necesarias
$fechahoy=date('d/m/Y');
//end Variables
$servidor="localhost";
  $usuarios="root";
  $password="";
  $db="auto_venta";
  $conexion=mysqli_connect($servidor,$usuarios,$password) or die("Error conectando...");
  mysqli_select_db($conexion,$db) or die("No consigue la base de datos");
  $_SESSION['conexion_database']=$conexion;
//Conexion con la bd
function cons($var){
$ret= mysqli_query($_SESSION['conexion_database'],$var) or die(mysqli_error($_SESSION['conexion_database']));
return $ret;  
}   
function cantidad($id_pieza){
$total1=0;
$consulta=("SELECT * FROM factura WHERE (habilitado=0 OR habilitado=3)");
$r=cons($consulta);
$total2=0;
while($row=mysqli_fetch_array($r)){
$id_factura=$row['id_factura'];
$consulta2=("SELECT * FROM detalle_factura WHERE id_pieza='$id_pieza' AND id_factura='$id_factura'");
$r2=cons($consulta2);
while($row2=mysqli_fetch_array($r2)){
   $total2=$total2+$row2['cantidad']; 
}
}
$consulta=("SELECT * FROM inventario WHERE id_pieza='$id_pieza' AND (habilitado=0 OR habilitado=3)");
$r=cons($consulta);
$total3=0;
while($row=mysqli_fetch_array($r)){
   $total3=$total3+$row['cantidad']; 
}
$restar=($total1+$total2);
$cantidad=($total3-$restar);

    return $cantidad;
}
?>
<!-- IMPORTANTE: El contenido de la etiqueta style debe estar entre comentarios de HTML -->
<style>
<!--
#tabla_inventario td{width:8%;padding:3px;}
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
.text-center{text-align:center;}
.fondo_azul{background-color: #6495ED;}
#footer {padding-top:5px 0; border-top: 2px solid #46d; width:100%;}
#footer .fila td {text-align:center; width:100%;}
#footer .fila td span {font-size: 10px; color: #000;}
#totales{position: fixed;bottom:5px; padding-left:600px;color:black; min-height: 25px;}
#totales .div1 {border:1px; }

-->
</style>
<!-- page define la hoja con los márgenes señalados -->
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
          <strong><span class="span3">Inventario</span><br><h4>Fecha: <?php echo $fechahoy; ?></h4></strong>
        </td>

            </tr>
            </table>
     <page_footer footer="page"> <!-- Define el footer de la hoja -->
		<table id="footer">
            <tr class="fila">
				<td>
				 [[page_cu]]/[[page_nb]]
				</td>
			</tr>
        </table>
    </page_footer>
  <!-- Define el cuerpo de la hoja -->
<?php
$consulta=("SELECT DISTINCT(id_pieza) FROM inventario WHERE habilitado=0");
$s=mysqli_query($_SESSION['conexion_database'],$consulta) or die(mysqli_error($_SESSION['conexion_database']));
if(mysqli_num_rows($s)<=0){
echo alerta("No hay ningun inventario registrado");  
}else{
        echo '
           
              <table border="1px" id="tabla_inventario" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Rango</th>
                  <th>Referencia</th>
                  <th>Articulo</th>                 
                  <th>Existencia S</th>
                  <th>Existencia R</th>
                </tr>
                </thead>
                <tbody id="prep">
               ';
        while($row=mysqli_fetch_array($s)){
        $id_pieza=$row['id_pieza'];
      $consulta2=("SELECT * FROM pieza WHERE id_pieza='$id_pieza' AND habilitado=0 ORDER BY id_rango");
      $s2=mysqli_query($_SESSION['conexion_database'],$consulta2) or die(mysqli_error($_SESSION['conexion_database']));

      if(mysqli_num_rows($s2)<=0){
    
      }else{   
      while($row2=mysqli_fetch_array($s2)){
        $id_rango=$row2['id_rango'];
        $referencia=$row2['codigo_pieza'];
        $nombre_pieza=$row2['nombre'];
		
      $consulta3=("SELECT * FROM rango WHERE id_rango='$id_rango' AND habilitado=0");
      $s3=mysqli_query($_SESSION['conexion_database'],$consulta3) or die(mysqli_error($_SESSION['conexion_database']));

      if(mysqli_num_rows($s3)<=0){
      echo "Error en consulta 2";  
      }else{
      while($row3=mysqli_fetch_array($s3)){
        $nombre_rango=$row3['nombre'];
        echo '<tr>
        <td>'.substr($nombre_rango, 0, 14).'</td>
        <td>'.$referencia.'</td>
        <td>'.$nombre_pieza.'</td>
        <td>'.cantidad($id_pieza).'</td>
        <td></td>
        </tr>';
      }
        
        }
       
      }
    }
  }
   echo ' </tbody>
              </table>
            '; 
}
?>


</page>
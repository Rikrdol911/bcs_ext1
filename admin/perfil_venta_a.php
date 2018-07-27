<?php include("menu.php");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Panel Administrativo
        <small>Version 1.0 BETA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="ragno_fiscal.php"><i class="fa fa-dashboard"></i> Volver</a></li>
        <li class="active">Venta</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->
  <!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_GET['id'])){
$id_factura=filtroxss($_GET['id']);
$consulta=("SELECT * FROM factura WHERE id_factura='$id_factura' AND habilitado=3 LIMIT 1");
$f=cons($consulta);
if(mysqli_num_rows($f)<=0){
echo alerta("No existe el proveedor seleccionado"); 
}else{
while($row=mysqli_fetch_array($f)){
$id_factura=$row['id_factura'];
$fecha1=$row['fecha'];
$explo=explode('-', $fecha1);
$fecha=$explo[2]."/".$explo[1]."/".$explo[0];
$id_cliente=$row['id_cliente'];
$iva=$row['iva']; 
$consulta3=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' AND habilitado=0" );
$s3=cons($consulta3);
$tmontot=0;
while($row3=mysqli_fetch_array($s3)){
$cliente=$row3['nombre'];
$dni=$row3['dni'];
$id_tipo=$row3['id_tipo'];
$consulta3p=("SELECT * FROM tipo WHERE id_tipo='$id_tipo'");
$s3p=cons($consulta3p);
while($row3p=mysqli_fetch_array($s3p)){
$nombre_tipo=$row3p['nombre'];
}
}
 echo '<div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Fecha '.$fecha.'<br> Venta N°'.$id_factura.'<br> '.$nombre_tipo.'-'.$dni.'<br>'.$cliente.'</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>C&oacute;digo</th>
                  <th>Pieza</th>
                  <th>Precio Unitario</th>                 
                  <th>Cantidad</th>
                  <th>Bs</th>
                </tr>
                </thead>
                <tbody id="prep">';
$subtotal=0;
$consulta2=("SELECT * FROM detalle_factura WHERE id_factura='$id_factura'");
$s2=cons($consulta2);
if(mysqli_num_rows($s2)<=0){
echo alerta("Error en consulta 1");  
}else{
while($row2=mysqli_fetch_array($s2)){
$monto=$row2['monto'];
$cantidad=$row2['cantidad'];
$id_pieza=$row2['id_pieza'];
$monto_pieza=($monto*$cantidad);
$subtotal=($subtotal+$monto_pieza);
$consulta3=("SELECT * FROM pieza WHERE id_pieza='$id_pieza'");
$s3=cons($consulta3);
if(mysqli_num_rows($s3)<=0){
echo alerta("Error en consulta 1");  
}else{
while($row3=mysqli_fetch_array($s3)){ 
$nombre_pieza=$row3['nombre'];
$codigo=$row3['codigo_pieza'];
echo '<tr>
<td>'.$codigo.'</td>
<td>'.$nombre_pieza.'</td>
<td>'.number_format($monto,2,",",".").'</td>
<td>'.$cantidad.'</td>
<td>'.number_format($monto_pieza,2,",",".").'</td>
</tr>';
} 
}
}    
}
echo '</tbody>
<tfoot>
<tr>
                  <th>C&oacute;digo</th>
                  <th>Pieza</th>
                  <th>Precio Unitario</th>                 
                  <th>Cantidad</th>
                  <th>Bs</th>
                </tr>
</tfoot>
</table>
</div>
            <!-- /.box-body -->
          </div>';


}
?>
<style>
#totales{
position: fixed;
bottom: 0px;
right: 0px;
z-index: 100000000000000;
color:#FFF;
min-height: 25px;
background-color: #0099FF;

}
</style>
        <?php
        echo '<div id="totales" class="callout callout-info">
Subtotal: '.number_format($subtotal,2,",",".").' Bs<br>
IVA '.$iva.'%: '.number_format((($subtotal*$iva)/100),2,",",".").' Bs<br>
<h4>Total: '.number_format(((($subtotal*$iva)/100)+$subtotal),2,",",".").' Bs</h4>
              </div>';
}
}
}
include("footer.php");
?>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
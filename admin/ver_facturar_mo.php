<?php include("menu.php");
?>
 <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Panel Administrativo
        <small>Version 1.0 BETA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Ver Ventas Mostrador</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
?>
            <!-- box-header -->
<div class="box box-primary collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Buscar Venta Mostrador</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="formulario" role="form" method="GET" enctype="multipart/form-data" action="rango_ventas_mo.php">
              <div class="box-body">
                       <!-- Date range -->
              <div class="col-lg-10 col-md-10 col-xs-10">
              <div class="form-group col-md-offset-2">
                <label>Buscar por Rango: </label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation" name="venta_fecha">
                </div>
                <!-- /.input group -->
              </div>
              </div>
                <!-- /.Date range -->
              </div>
              <!-- Btn Envio -->
              <div class="box-footer text-center">
                <button type="submit" id="ref" class="btn btn-primary">Buscar</button>
              </div>
              <!-- /.btn envio -->
              </form>
              <!-- form end -->
              </div>
<?php
$consulta=("SELECT * FROM factura WHERE habilitado=0 AND ml=1");
      $s=cons($consulta);
      if(mysqli_num_rows($s)<=0){
      echo alerta("No hay Ventas Mostrador registradas");  
      }else{
        echo '<div class="box box-danger">
            <div class="box-header with-border text-center">
              <h3 class="box-title">Ventas Mostrador</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Fecha</th>
                  <th>N° Factura</th>
                  <th>Cliente</th>                 
                  <th>IVA</th>
                  <th>Monto</th>
                  <th>Flete</th>
                  <th>Motivo</th>
                </tr>
                </thead>
                <tbody id="prep">';
$total_iva=0;
$total_monto=0;
$total_flete=0;
$total_mercado=0;
$total_venta11=0;
while($row=mysqli_fetch_array($s)){
$id_factura=$row['id_factura'];
$fecha1=$row['fecha'];
$explo=explode('-', $fecha1);
$fecha=$explo[2]."/".$explo[1]."/".$explo[0];
$id_cliente=$row['id_cliente'];
$iva1=$row['iva'];
$flete1=$row['flete'];
$ml=$row['ml'];
$consulta3=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' AND habilitado=0" );
$s3=cons($consulta3);
$tmontot=0;

while($row3=mysqli_fetch_array($s3)){
$cliente=$row3['nombre'];
$consulta2=("SELECT * FROM detalle_factura WHERE id_factura='$id_factura'");
$s2=cons($consulta2);
$monto_pieza=0;
$tiva=0;
$tmonto=0;
if(mysqli_num_rows($s2)<=0){
echo alerta("Error en consulta 1");  
}else{
while($row2=mysqli_fetch_array($s2)){
$monto11=$row2['monto'];
$cantidad11=$row2['cantidad'];
$monto_pieza2=($monto11*$cantidad11);
$monto_pieza=($monto_pieza+$monto_pieza2);
  
}
$tiva=($monto_pieza*($iva1/100));  
$tmonto=($monto_pieza+$tiva);
} 
if ($ml==0) {
  $motivo="MercadoLibre";
  $mercadolibre=$tmonto;
}else{
  $motivo="Venta";
  $mercadolibre=0;
  $venta11=$tmonto;
}
echo '<tr>
<td><a href="perfil_venta.php?id='.$id_factura.'">'.$fecha.'</a></td>
<td><a href="perfil_venta.php?id='.$id_factura.'">'.$id_factura.'</a></td>
<td>'.$cliente.'</td>
<td>'.number_format($tiva,2,",",".").'&nbsp;Bs</td>
<td>'.number_format($tmonto,2,",",".").'&nbsp;Bs</td>
<td>'.number_format($flete1,2,",",".").'&nbsp;Bs</td>
<td>'.$motivo.'&nbsp;</td>
</tr>'; 
$total_iva=($total_iva+$tiva);
$total_monto=($total_monto+$tmonto);
$total_flete=($total_flete+$flete1);
$total_mercado=($total_mercado+$mercadolibre);
$total_venta11=($total_venta11+$venta11);
}
}
echo '</tbody>
<tfoot>
    <tr>
                  <th>Fecha</th>
                  <th>N° Factura</th>
                  <th>Cliente</th>                 
                  <th>IVA</th>
                  <th>Monto</th>
                  <th>Flete</th>
                  <th>Motivo</th>
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
if (!isset($total_iva) && !isset($total_monto)) {
$total_iva=0;
$total_monto=0;  
$total_mercado=0;
$total_flete=0;
}
echo '<div id="totales" class="callout callout-info">
Total Flete: '.number_format($total_flete,2,",",".").' Bs
<br>Total IVA: '.number_format($total_iva,2,",",".").'
 Bs<br><h4>Total: '.number_format(($total_iva+($total_monto)),2,",",".").' Bs</h4>
</div>';
              ?>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<?php 
}
include("footer.php");
?>
<script>
$(document).ready(function(){
  $(function () {

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );
  });
    });
</script>
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
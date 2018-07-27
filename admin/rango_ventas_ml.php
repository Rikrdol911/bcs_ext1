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
        <li><a href="ver_facturar_ml.php"><i class="fa fa-dashboard"></i> Volver</a></li>
        <li class="active">Ver Ventas</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_GET['venta_fecha'])) {
$fechajuntas1=$_GET['venta_fecha'];
$fechasjuntas=trim($fechajuntas1," ");
$separa=explode(" - ",$fechasjuntas);
$fecha1=str_replace("/","-",$separa[0]);
$fecha2=str_replace("/","-",$separa[1]);
$fe=explode("-",$fecha1);
$fecha1=$fe[2]."-".$fe[0]."-".$fe[1];
$fe=explode("-",$fecha2);
$fecha2=$fe[2]."-".$fe[0]."-".$fe[1];
?>
<!-- box-header -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Resultado fechas del: <?php echo $fecha1." al ".$fecha2; ?> MercadoLibre<br></h3>
</div>
<div class="box-body">
<?php
$consulta=("SELECT * FROM factura WHERE habilitado=0 AND ml=0 AND fecha BETWEEN date('$fecha1') AND date('$fecha2')");
      $s=cons($consulta);
      if(mysqli_num_rows($s)<=0){
      echo alerta("No hay Ventas MercadoLibre registradas");  
      }else{
        echo '
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Fecha</th>
                  <th>N° Factura</th>
                  <th>Cliente</th>                 
                  <th>ML</th>
                  <th>Monto</th>
                  <th>Flete</th>
                  <th>Motivo</th>
                </tr>
                </thead>
                <tbody id="prep">';
$total_iva=0;
$total_monto=0;
$tmonto1=0;
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
$venta11=0;
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
$tmonto1=($tmonto1+$monto_pieza);
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
                  <th>ML</th>
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
echo '<div id="totales" class="callout callout-info">
Total Flete: '.number_format($total_flete,2,",",".").' Bs<br>
Comisi&oacute;n ML: '.number_format($total_iva,2,",",".").' Bs<br>
MercadoLibre: '.number_format($total_mercado,2,",",".").' Bs<br>
<h4>Total: '.number_format(($total_iva+($total_mercado)),2,",",".").' Bs</h4>
</div>';
?>
<?php 
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
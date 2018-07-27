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
        <li><a href="ver_facturar.php"><i class="fa fa-dashboard"></i> Volver</a></li>
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
$consulta=("SELECT * FROM factura WHERE id_factura='$id_factura' AND habilitado=0 LIMIT 1");
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
$imp=$row['imp'];
$flete=$row['flete'];
$ml=$row['ml']; 
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
$mercado="";
if ($id_tipo==11) {
  $mercado="VENTA MERCADOLIBRE";
}
 echo '<div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Fecha '.$fecha.'&nbsp;&nbsp;&nbsp;<b>'.$mercado.'</b><br> Venta N°'.$id_factura.'<br> '.$nombre_tipo.'-'.$dni.'<br>'.$cliente.'<br>Flete: '.$flete.'</h3>
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
left: 0px;
z-index: 100000000000000;
color:#FFF;
min-height: 25px;
background-color: #0099FF;

}
</style>
        <?php
        echo '<div id="totales" class="callout callout-info">
Subtotal: '.number_format($subtotal,2,",",".").' Bs<br>
IVA '.$iva.'%/ ML:   '.number_format((($subtotal*$iva)/100),2,",",".").' Bs <br>Flete: '.number_format($flete,2,",",".").'Bs
';

if ($ml==1) {
echo '
<h4>Total: '.number_format(((($subtotal*$iva)/100)+$subtotal),2,",",".").' Bs</h4>
              </div>';
}else{
$total_total1=((($subtotal*$iva)/100)-$subtotal);
$total_total=($total_total1)*(-1);
echo '
<h4>Total: '.number_format($total_total,2,",",".").' Bs</h4>
              </div>';  
}
}
echo '<div class="box box-default collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Procesar</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body text-center">';
if ($imp==0) {
  

//echo  '<form name="formfacturar" method="GET" action="imprimir_factura.php"><input type="hidden" name="id" value="'.$id_factura.'"><button type="submit" class="btn btn-warning">Imprimir Factura</button></form><hr>';
}
 echo '<form id="formulario3" role="form" method="POST" enctype="multipart/form-data" action="pro_eliminar_venta.php">
            <input type="hidden" name="id_factura" value="'.$id_factura.'">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Eliminar Venta</button>
             </div>
            </div>
            <!-- Modal -->
<div id="myModal" class="modal fade col-lg-offset-1 col-md-offset-1 col-xs-offset-0" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Desea Realizar la Operaci&oacute;n?</h3>
      </div>
      <div class="modal-body">
        <p>Eliminar Venta?</p><h5>N°&nbsp;'.$id_factura.'.</h5>
        <p>Introdusca el n&uacute;mero de factura para confirmar:</p>
        <input type="text" name="ventacof" class="form-control" placeholder="N&uacute;mero de Venta" maxlength="15" required>
     
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Eliminar Venta</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>';         

             echo '</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>';
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
<script>
  $(document).ready(function(){
        $("#formulario3").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formulario3"));
            formData.append("dato", "valor");
      $("#ref").hide();
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: $(this).attr('action'),
                type: "post",
        dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
              processData: false
            })
                .done(function(res){
          
          $("#ref").show();
                    $("#respuesta").html(res);
                });
        });
    });
    </script>
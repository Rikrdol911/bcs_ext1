<?php include("menu.php");
?>
<script src="jquery.maskedinput.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
$(".telf").mask("(9999) 9999-999");
});
</script>
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
        <li class="active">Facturar</li>
      </ol>
    </section>
<!-- /.Content Header (Page header) -->
 <!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
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
$ml=$row['ml']; 
  $consulta=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' AND habilitado=0 LIMIT 1");
  $f=cons($consulta);
  if(mysqli_num_rows($f)<=0){
  echo alerta("No existe el cliente seleccionado"); 
  }else{
  
  while($row=mysqli_fetch_array($f)){
    $nomb=$row['nombre'];
    $id_tp=$row['id_tipo'];
echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><b>IMPRIMIR A NOMBRE DE:</b></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form id="formulario" role="form" method="POST" enctype="multipart/form-data" action="../EpsonVE/php/facturar_venta.php">
              <div class="box-body">
              <input type="hidden" name="id_factura" value="'.$id_factura.'">
          <!-- Documento Nacional de Identidad -->
          <div class="col-lg-4 col-md-4 col-xs-10">
          <div class="form-group">
                  <label for="Tipo de Documento">Tipo de Documento</label>
                  <select class="form-control" name="tipo" required>';

$consultaa=("SELECT * FROM tipo");
$da=cons($consultaa);
while($rowa=mysqli_fetch_array($da)){
  $elti=$rowa['id_tipo'];
  if($elti==$id_tp){
    echo "<option selected value=".$rowa['id_tipo'].">".$rowa['nombre']."</option>";  
  }else{
echo "<option value=".$rowa['id_tipo'].">".$rowa['nombre']."</option>"; 
  }
}
              echo '</select>
                </div>
                </div>
        <div class="col-lg-4 col-md-4 col-xs-10">
        <div class="form-group">
                  <label for="Documento">Documento</label>
                  <input type="text" maxlength="10" class="form-control" placeholder="Ingresa el documento de identidad" name="dni" value="'.$row['dni'].'" required>
                </div>
                </div>
                <!-- /.Documento Nacional de Identidad -->

                 <!-- Nombre de Cliente -->
                <div class="col-lg-4 col-md-4 col-xs-10">
          <div class="form-group">
                  <label for="Nombre">Nombre</label>
                  <input type="text" class="form-control" placeholder="Ingresa el nombre del cliente" name="nombre" value="'.$nomb.'" maxlength="26" required>
                </div>
                </div>
                <!-- /.Nombre de Cliente -->
                </div>';
          if ($imp==1) {
          echo negativo("Esta factura ya se ha impreso");           
          }else{ echo '<div class="box-footer text-center" id="aparecer">
                <button type="submit" class="btn btn-info">Generar Factura</button>
                </div>';}
               
               echo '</form></div>';
}
}
}
echo '<div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Resumen de Venta</b><br>Fecha&nbsp;'.$fecha.'&nbsp;Venta N°'.$id_factura.' (No es N° de Factura)</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
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
</table>
</div>
            <!-- /.box-body -->
          </div></div>';


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
</section>
        <?php
        echo '<div id="totales" class="callout callout-info">
Subtotal: '.number_format($subtotal,2,",",".").' Bs<br>
IVA / ML '.$iva.'%: '.number_format((($subtotal*$iva)/100),2,",",".").' Bs<br>';
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
?>
<script>
  $(document).ready(function(){
        $("#formulario").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formulario"));
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
<?php
include("footer.php");
?>
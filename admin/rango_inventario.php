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
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Ver Inventario</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_GET['inventario_fecha'])) {
$fechajuntas1=$_GET['inventario_fecha'];
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
              <h3 class="box-title">Resultado fechas del: <?php echo $fecha1." al ".$fecha2; ?> </h3>
            </div>
            <div class="box-body">
       
            <?php
$consulta=("SELECT * FROM inventario WHERE habilitado=0 AND fecha BETWEEN date('$fecha1') AND date('$fecha2')");
      $s=cons($consulta);
      if(mysqli_num_rows($s)<=0){
      echo alerta("No hay ningun inventario registrado");  
      }else{
        echo '<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Rango</th>
                  <th>Referencia</th>
                  <th>Articulo</th>
                  <th>Factura</th>
                  <th>Existencia</th>
                </tr>
                </thead>
                <tbody id="prep">
               ';
        while($row=mysqli_fetch_array($s)){
        $id_pieza=$row['id_pieza'];
        $n_factura=$row['n_factura'];
		$id_proveedor=$row['id_proveedor'];
      $consulta2=("SELECT * FROM pieza WHERE id_pieza='$id_pieza' AND habilitado=0");
      $s2=cons($consulta2);
      if(mysqli_num_rows($s2)<=0){
      echo alerta("Error en consulta 1");  
      }else{   
      while($row2=mysqli_fetch_array($s2)){
        $id_rango=$row2['id_rango'];
        $referencia=$row2['codigo_pieza'];
        $nombre_pieza=$row2['nombre'];
      $consulta3=("SELECT * FROM rango WHERE id_rango='$id_rango' AND habilitado=0");
      $s3=cons($consulta3);
      if(mysqli_num_rows($s3)<=0){
      echo alerta("Error en consulta 2");  
      }else{
      while($row3=mysqli_fetch_array($s3)){
        $nombre_rango=$row3['nombre'];
        echo '<tr>
        <td>'.$nombre_rango.'</td>
        <td>'.$referencia.'</td>
        <td>'.$nombre_pieza.'</td>
        <td><a href="facturas.php?n_fac='.$n_factura.'&id_proveedor='.$id_proveedor.'">'.$n_factura.'</a></td>
        <td>-</td>
        </tr>';
      }
        
        }
       
      }
    }
  }
   echo ' </tbody>
                <tfoot>
                <tr>
                 <th>Rango</th>
                  <th>Referencia</th>
                  <th>Articulo</th>
                  <th>Factura</th>
                  <th>Existencia</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>  
             </div>
            </div>'; 
}
?>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
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
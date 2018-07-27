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
        <li class="active">Ver Inventario</li>
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
              <h3 class="box-title">Buscar Inventario</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="formulario" role="form" method="GET" enctype="multipart/form-data" action="rango_inventario.php">
              <div class="box-body">
                       <!-- Date range -->
              <div class="col-lg-10 col-md-10 col-xs-10">
              <div class="form-group col-md-offset-2">
                <label>Buscar por Rango: </label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation" name="inventario_fecha">
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
$consulta=("SELECT DISTINCT(id_pieza) FROM inventario WHERE habilitado=0");
$s=cons($consulta);
if(mysqli_num_rows($s)<=0){
echo alerta("No hay ningun inventario registrado");  
}else{
        echo '<div class="box box-danger">
            <div class="box-header with-border text-center">
              <h3 class="box-title">Inventario General</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Rango</th>
                  <th>Referencia</th>
                  <th>Articulo</th>                 
                  <th>Existencia</th>
                </tr>
                </thead>
                <tbody id="prep">
               ';
        while($row=mysqli_fetch_array($s)){
        $id_pieza=$row['id_pieza'];
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
        <td><h4><a class="link" href="perfil_pieza.php?id='.$id_pieza.'">'.cantidad($id_pieza).'</a></h4></td>
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
                  <th>Existencia</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>'; 
}
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
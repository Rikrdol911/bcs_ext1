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
        <li class="active">Editar Pieza</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
?>
            <!-- box-header -->
<?php
      $consulta2=("SELECT * FROM pieza WHERE habilitado=0");
      $s2=cons($consulta2);
      if(mysqli_num_rows($s2)<=0){
      echo alerta("Error en consulta 1");  
      }else{   
        echo '<div class="box box-danger">
            <div class="box-header with-border text-center">
              <h3 class="box-title">Piezas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Rango</th>
                  <th>Referencia</th>
                  <th>Articulo</th>                     
                </tr>
                </thead>
                <tbody id="prep">
               ';
      while($row2=mysqli_fetch_array($s2)){
        $id_rango=$row2['id_rango'];
        $referencia=$row2['codigo_pieza'];
        $nombre_pieza=$row2['nombre'];
		    $id_pieza=$row2['id_pieza'];
      $consulta3=("SELECT * FROM rango WHERE id_rango='$id_rango' AND habilitado=0");
      $s3=cons($consulta3);
      if(mysqli_num_rows($s3)<=0){
      echo alerta("Error en consulta 2");  
      }else{
      while($row3=mysqli_fetch_array($s3)){
        $nombre_rango=$row3['nombre'];
        echo '<tr>
        <td>'.$nombre_rango.'</td>
        <td><a href="edit_pieza.php?id='.$id_pieza.'">'.$referencia.'</a></td>
        <td><a href="edit_pieza.php?id='.$id_pieza.'">'.$nombre_pieza.'</a></td>
        </tr>';
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
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>'; 
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
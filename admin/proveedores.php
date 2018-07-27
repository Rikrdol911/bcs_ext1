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
        <li class="active">Proveedores</li>
      </ol>
    </section>
   <!-- /.Content Header (Page header) -->

	<!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
$consulta=("SELECT * FROM proveedor WHERE habilitado=0");
		  $s=cons($consulta);
       
      $consult=("SELECT * FROM tipo");
      $d=cons($consult);
      $ti=array();
      while($fg=mysqli_fetch_array($d)){
        $ti[$fg['id_tipo']]=$fg['nombre'];
      }
		  if(mysqli_num_rows($s)<=0){
			echo alerta("No hay ningun proveedor registrado");  
		  }else{
 echo '<div class="box box-primary with-border">
            <div class="box-header">
              <h3 class="box-title">Proveedores Registrados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Identificaci&oacute;n</th>
                  <th>Nombre</th>
                  <th>Tel&eacute;fono</th>
                  <th>Correo</th>
                </tr>
                </thead>
                <tbody id="prep">
               ';
                 while($row=mysqli_fetch_array($s)){
				  
			  echo ' <tr>
                  <td>'.$ti[$row['id_tipo']].'- '.$row['rif'].'</td>
                  <td> <a href="perfil_proveedor.php?id='.$row['id_proveedor'].'">'.$row['nombre'].'</a></td>
                  <td>'.$row['telf'].'</td>
                  <td>'.$row['correo'].'</td>
                </tr> ';
			  
			  }
			   echo ' </tbody>
                <tfoot>
                <tr>
                   <th>Identificaci&oacute;n</th>
                  <th>Nombre</th>
                  <th>Tel&eacute;fono</th>
                  <th>Correo</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>';

		  }
?>

</section>
</div>
    <?php
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
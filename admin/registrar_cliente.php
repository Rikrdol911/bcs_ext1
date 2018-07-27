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
        <li class="active">Registrar Cliente</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
	echo '<div class="box box-primary collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Registrar Cliente</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            
            <!-- form start -->
            <form id="formulario" role="form" method="POST" enctype="multipart/form-data" action="pro_registrar_cliente.php">
              <div class="box-body">

          <!-- Documento Nacional de Identidad -->
          <div class="col-lg-4 col-md-4 col-xs-10">
			    <div class="form-group">
                  <label for="Tipo de Documento">Tipo de Documento</label>
                  <select class="form-control" name="tipo" required>';

$consulta=("SELECT * FROM tipo ORDER BY id_tipo DESC");
$d=cons($consulta);
while($row=mysqli_fetch_array($d)){
echo "<option value=".$row['id_tipo'].">".$row['nombre']."</option>";	
}
              echo '</select>
                </div>
                </div>
                
                <div class="col-lg-4 col-md-4 col-xs-10">
				<div class="form-group">
                  <label for="Documento">Documento</label>
                  <input type="text" class="form-control" placeholder="Ingresa el documento de identidad" name="dni" maxlength="10" required>
                </div>
                </div>
                <!-- /. Documento Nacional de Identidad -->

                <!-- Nombre de Cliente -->
                <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Nombre">Nombre</label>
                  <input type="text" class="form-control" placeholder="Ingresa el nombre del cliente" name="nombre" required>
                </div>
                </div>
                <!-- /. Nombre de Cliente -->

                <!-- Telefono Clinte -->
          <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Telefono</label>
                  <input type="text" maxlength="10" class="form-control telf" placeholder="Ingresa el telefono celular" name="telefono" required>
                </div>
                </div>
                <!-- /. Telefono -->

                <!-- Direccion -->
          <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Direccion">Direcci&oacute;n</label>
                  <textarea class="form-control" placeholder="Direccion del cliente" name="direccion" required></textarea>
                </div>
                </div>
                <!-- /. Direccion -->

                <!-- Correo -->
                <div class="col-lg-4 col-md-4 col-xs-10">
                <div class="form-group">
                  <label for="Correo">Correo Electronico*</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingresa el Correo electronico" name="correo">
                </div>
                </div>
                <!-- /. Correo -->

                <!-- Imagen de DNI -->
                <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group">
                  <label for="imagen documento">Documento De Identidad *</label>
                  <input type="file" name="cedula" id="exampleInputFile">
                </div>
                </div>
                <!-- /. Imagen de DNI -->

              <!-- Imagen de Carnet -->
              <div class="col-lg-12 col-md-4 col-xs-12">
  				    <div class="form-group">
                  <label for="Carnet Circulacion">Carnet De Circulacion *</label>
                  <input type="file" name="carnet" id="exampleInputFile">
                </div>
                </div>
              <!-- /. Imagen de Carnet -->

              <div class="col-lg-12 col-md-4 col-xs-12 text-center">
                <div class="checkbox">
                  <label>
                    Campos con (*) son opcionales
                  </label>
                </div>
              </div>
              </div>
              <!-- /.box-body -->

              <!-- Btn Envio -->
              <div class="box-footer text-center">
                <button type="submit" id="ref" class="btn btn-primary">Registrar Cliente</button>
              </div>
              <!-- /.btn envio -->

            </form>
            <!-- /.formulario cliente -->
          </div>';
		  echo "<div id='clearfix'></div>";
		  $consult=("SELECT * FROM tipo");
		  $d=cons($consult);
		  $ti=array();
		  while($fg=mysqli_fetch_array($d)){
			  $ti[$fg['id_tipo']]=$fg['nombre'];
		  }
		  $consulta=("SELECT * FROM cliente WHERE habilitado=0");
		  $s=cons($consulta);
		  if(mysqli_num_rows($s)<=0){
			echo alerta("No hay ningun cliente registrado");  
		  }else{
			  echo '<div class="box box-danger">
            <div class="box-header with-border text-center">
              <h3 class="box-title">Clientes Registrados</h3>
              </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Identificaci&oacute;n</th>
                  <th>Nombre</th>
                  <th>Tel&eacute;fono</th>
                </tr>
                </thead>
                <tbody id="prep">
               ';
			  while($row=mysqli_fetch_array($s)){
				  
			  echo ' <tr>
                  <td>'.$ti[$row['id_tipo']].'- '.$row['dni'].'</td>
                  <td> <a href="perfil.php?id='.$row['id_cliente'].'">'.$row['nombre'].'</a></td>
                  <td>'.$row['telf'].'</td>
                </tr> ';
			  
			  }
			  echo ' </tbody>
                <tfoot>
                <tr>
                  <th>Identificaci&oacute;n</th>
                  <th>Nombre</th>
                  <th>Tel&eacute;fono</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
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
</section>
</div>
    <?php
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
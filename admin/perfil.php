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
        <li><a href="registrar_cliente.php"><i class="fa fa-dashboard"></i> Volver</a></li>
        <li class="active">Perfil de Cliente</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_GET['id'])){
	$id_cliente=filtroxss($_GET['id']);
	$consulta=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' AND habilitado=0 LIMIT 1");
	$f=cons($consulta);
	if(mysqli_num_rows($f)<=0){
	echo alerta("No existe el cliente seleccionado");	
	}else{
	
	while($row=mysqli_fetch_array($f)){
		$nomb=$row['nombre'];
		$id_tp=$row['id_tipo'];
		$fotos=unserialize($row['images']);
		echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><b>'.$nomb.'</b></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form id="formulario" role="form" method="POST" enctype="multipart/form-data" action="pro_actualizar_cliente.php">
              <div class="box-body">
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
                  <input type="text" class="form-control" placeholder="Ingresa el nombre del cliente" name="nombre" value="'.$nomb.'" required>
                </div>
                </div>
                <!-- /.Nombre de Cliente -->

                <!-- Telefono Clinte -->
          <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="exampleInputEmail1">Telefono</label>
                  <input type="text" class="form-control telf" placeholder="Ingresa el telefono celular" name="telefono" value="'.$row['telf'].'" required>
				  <input type="hidden" name="id" value="'.$id_cliente.'" required>
                </div>
                </div>
                <!-- /.Telefono Clinte -->

                <!-- Direccion -->
          <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="exampleInputEmail1">Direcci&oacute;n</label>
                  <textarea class="form-control" placeholder="Direccion del cliente" name="direccion" required>'.$row['direccion'].'</textarea>
                </div>
                </div>
                <!-- /.Direccion -->

                <!-- Correo -->
                <div class="col-lg-4 col-md-4 col-xs-10">
                <div class="form-group">
                  <label for="Direccion">Correo Electronico</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingresa el Correo electronico" required name="correo" value="'.$row['correo'].'">
                </div>
                </div>
               <!-- /.Correo -->

                <div class="checkbox">
                
                </div>
             

                 
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
          </div>
            <div class="col-lg-12 col-md-4 col-xs-12 text-center">
                <div class="checkbox">
                  <label>
                    Campos con (*) son opcionales
                  </label>
                </div>
              </div>
              <!-- /.box-body -->
          <div class="box-footer text-center">
                <button type="submit" id="ref" class="btn btn-primary">Actualizar Cliente</button>
              </form>
          ';
          echo '<hr><form id="formulario2" role="form" method="POST" enctype="multipart/form-data" action="pro_eliminar_cliente.php">
            <input type="hidden" name="id_cliente" value="'.$row['id_cliente'].'">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Eliminar Cliente</button>
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
        <p>Eliminar Cliente?</p><h5>'.$rowa['nombre'].'&nbsp;'.$row['dni'].'&nbsp;'.$row['nombre'].'&nbsp;'.$row['correo'].'&nbsp;'.$row['direccion'].'.</h5>
     

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Eliminar Cliente</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>';
		  echo "<div id='clearfix'></div>";	
		  if(count($fotos)>=1){
			echo '<div class="col-md">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Documentos</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">
              ';
            foreach($fotos as $img){
			echo '<img class="img-responsive" src="documentos/'.$img.'"/><br>';	
				
			}
			
			echo '</div>
            <!-- /.box-body -->

          </div>

          <!-- /.box -->

        </div>';  
		  }
		
	}
	
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
<script>
  $(document).ready(function(){
        $("#formulario2").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formulario2"));
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
</section>
</div>
<?php
}
include("footer.php");
?>
<script>
$(document).ready(function(){
$(".telf").mask("(9999) 9999-999");
});
</script>
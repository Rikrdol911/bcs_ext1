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
        <li class="active">Facturar</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
    <style>
	#ref{
		display:none;	
	}
	</style>
<script>
$(document).ready(function(){
$('.verificar').click(function() {
  // Enviamos el formulario usando AJAX
  var dni = $("#dn").val();
  var tip = $("#tip").val();
        $.ajax({
			async: true,   
            type: 'POST',
            url: 'verificar_registro_factura.php',
            data: {dni:dni,tip:tip},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#mas').html(data);
				$('#ref').show();
            }
        })        
        return false;
  
    }); 
   
$("body").on("click",".elimform-control", function(){
	 var ps = $(this).attr("ps");
	$(".a"+ps).remove();
	  });		
}); 	

</script>
<style>
#aparecer{
	display:none;
}
</style>
<?php
if(isset($_SESSION['ingreso'])){
echo '<div>
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Facturar</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: block;">
 <form id="formulario" role="form" method="POST" enctype="multipart/form-data" action="pro_registrar_factura.php">
              <div class="box-body">

          <!-- Documento Nacional de Identidad -->
          <div class="col-lg-3 col-md-3 col-xs-10">
			    <div class="form-group">
                  <label for="Tipo de Documento">Tipo de Documento</label>
                  <select class="form-control" name="tipo" id="tip" required>';
if(isset($tipo)){
$consulta=("SELECT * FROM tipo WHERE id_tipo='$tipo'");	
}else{
$consulta=("SELECT * FROM tipo");
}
$d=cons($consulta);
while($row=mysqli_fetch_array($d)){
echo "<option value=".$row['id_tipo'].">".$row['nombre']."</option>";	
}
              echo '</select>
                </div>
                </div>
                
        <div class="col-lg-5 col-md-5 col-xs-10">
				<div class="form-group">
        <label for="Documento">Documento</label>';
				  
       echo '  
			  <div class="input-group">
                <input type="text" id="dn" class="form-control" placeholder="Ingresa el documento de identidad" name="dni" maxlength="10" required>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat verificar">Verificar</button>
                    </span>
              </div>'; 
$fecha_hoy=date('Y-m-d');		
          echo ' </div>
                </div>
<div class="col-lg-4 col-md-4  col-xs-10">
        <div class="form-group">
        <label for="Documento">Fecha</label>
 <div class="input-group">
                <input type="text" id="fecha" class="form-control" value="'.$fecha_hoy.'" name="fecha" required>
              </div></div></div><hr>
<div class="col-lg-2 col-md-2  col-xs-10">
				<div class="form-group">
        <label for="Documento">IVA %</label>
 <div class="input-group">
                <input type="text" id="dn" class="form-control" value="0" name="iva" required>
              </div></div></div>
              <div class="col-lg-2 col-md-2  col-xs-10">
        <div class="form-group">
        <label for="Documento">Flete</label>
 <div class="input-group">
                <input type="text" id="flete" class="form-control" value="0" name="flete" placeholder="Flete" required>
              </div></div></div>


                <div id="mas" class="col-lg-12 col-md-12 col-xs-12">
        </div>
        <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
				  <th>Precio</th>
				  <th>Cantidad</th>
				  <th>Accion</th>
                </tr>
                </thead>
                <tbody id="la_tabla">
				<tr>
				<td></td><td></td>
				<td></td><td></td>
				<td></td>
				</tr>
				
</tbody>
                <tfoot>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
				  <th>Precio</th>
				  <th>Cantidad</th>
				  <th>Accion</th>
                </tr>
                </tfoot>
              </table>
<div id="more"></div>
 </div></div></div>
 <div class="box-footer text-center" id="aparecer">
                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal">Procesar Venta</button>
              <!-- Modal -->
<div id="myModal" class="modal fade col-lg-offset-1 col-md-offset-1 col-xs-offset-0" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Desea Realizar la Venta?</h3>
      </div>
      <div class="modal-body">
      <p> Seguro de Realizar la Venta?</p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info">Procesar Venta</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>
 
              </div>
            </form>

           
            <!-- /.box-body -->
          
          <!-- /.box -->
        ';



}
include("footer.php");
?><script>
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
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
        <li class="active">Registrar Inventario</li>
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
  var tipo= $("#tip").val();
        $.ajax({
			async: true,   
            type: 'POST',
            url: 'verificar_proveedor.php',
            data: {dni:dni, tipo:tipo},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#mas').html(data);
				
            }
        })        
        return false;
  
    }); 		
$("body").on("click",".elim", function(){
	 var ps = $(this).attr("ps");
	$(".a"+ps).remove();
	$(".c"+ps).remove();
	  });

}); 	
</script>
<?php
if(isset($_SESSION['ingreso'])){
echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registrar Inventario</h3>
            </div>
            <!-- /.box-header -->
            
            <!-- form start -->
            <form class="formulario" role="form" method="POST" enctype="multipart/form-data" action="pro_registrar_inventario.php">
              <div class="box-body">
              <!-- Documento Nacional de Identidad -->
          <div class="col-lg-3 col-md-3 col-xs-10">
          <div class="form-group">
                  <label for="Documento">Documento</label>
                  <select class="form-control" name="tipo" id="tip" required>
                  <option value="9">J</option>';

$consulta=("SELECT * FROM tipo");
$d=cons($consulta);

while($row=mysqli_fetch_array($d)){
echo "<option value=".$row['id_tipo'].">".$row['nombre']."</option>"; 
}
              echo '</select>
                </div>
                </div>
                <!-- /. Documento Nacional de Identidad -->

        <div class="col-lg-9 col-md-9 col-xs-10">
        <div class="form-group">		   
        <label for="Documento">Documento Del Proveedor</label>
           <div class="input-group">
                <input type="text" id="dn" class="form-control" style="width: 100%;" placeholder="Ingresa el documento de identidad" name="dni" maxlength="9" required> 
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat verificar">Verificar</button>
                    </span>
              </div></div></div></div>

<div id="mas"></div>
<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Rango</th>
				  <th>Precio</th>
				  <th>Cantidad</th>
				  <th>Total</th>
				  <th>Accion</th>
                </tr>
                </thead>
                <tbody id="la_tabla">
				<tr>
				<td></td><td></td>
				<td></td><td></td>
				<td></td><td></td>
				<td></td>
				</tr>
				
</tbody>
                <tfoot>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Rango</th>
				  <th>Precio</th>
				  <th>Cantidad</th>
				  <th>Total</th>
				  <th>Accion</th>
                </tr>
                </tfoot>
              </table>
<div id="more"></div>
           
              
                
                  
                
			              <div class="box-footer text-center"><label>Pieza de Cliente&nbsp;&nbsp;
                    <input type="checkbox" name="taller" value="1">
                  </label><hr>
                <button type="submit" class="btn btn-primary">Registrar Inventario</button>
              </div>
            </form>
            </div>';
		  echo "<div id='clearfix'></div>";




?>
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

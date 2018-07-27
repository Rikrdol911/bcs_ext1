<?php include("menu.php");
?>
<script>
$(document).ready(function(){
$(".telf").mask("(9999) 9999-999");
});
</script>
<script src="jquery.maskedinput.js" type="text/javascript"></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Panel Administrativo
        <small>Version 1.0 BETA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="proveedores.php"><i class="fa fa-dashboard"></i> Volver</a></li>
        <li class="active">Perfil de Cliente</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->
  <!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_GET['id'])){
  $id_proveedor=filtroxss($_GET['id']);
  $consulta=("SELECT * FROM proveedor WHERE id_proveedor='$id_proveedor' AND habilitado=0 LIMIT 1");
  $f=cons($consulta);
  if(mysqli_num_rows($f)<=0){
  echo alerta("No existe el proveedor seleccionado"); 
  }else{
    while($row=mysqli_fetch_array($f)){
    $nomb=$row['nombre'];
    echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><b>'.$nomb.'</b></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form id="formulario" role="form" method="POST" enctype="multipart/form-data" action="pro_actualizar_proveedor.php">
              <div class="box-body">
              <!-- Documento Nacional de Identidad -->
          <div class="col-lg-4 col-md-4 col-xs-10">
          <div class="form-group">
                  <label for="Tipo de Documento">Tipo de Documento</label>
                  <select class="form-control" name="tipo" required>';
$id_tp=$row['id_tipo'];
$consulta4=("SELECT * FROM tipo WHERE id_tipo='$id_tp' LIMIT 1");
$da4=cons($consulta4);
while($row4=mysqli_fetch_array($da4)){
  echo "<option selected='selected' value=".$row4['id_tipo'].">".$row4['nombre']."</option>";
  }

$consultaa=("SELECT * FROM tipo");
$da=cons($consultaa);
while($rowa=mysqli_fetch_array($da)){
  $elti=$rowa['id_tipo'];
  if($elti==$id_tp){
    echo "<option value=".$rowa['id_tipo'].">".$rowa['nombre']."</option>";  
  }else{
echo "<option value=".$rowa['id_tipo'].">".$rowa['nombre']."</option>"; 
  }
}
              echo '</select>
                </div>
                </div>

               <div class="col-lg-4 col-md-4 col-xs-10">
               <div class="form-group">
                  <label for="Rif">Rif</label>
                  <input type="text" maxlength="10" class="form-control" placeholder="Ingresa el Rif de la Empresa" name="rif" value="'.$row['rif'].'" required>
                </div>
                </div>
                <!-- /.Documento Nacional de Identidad -->

                 <!-- Nombre de Empresa -->
                <div class="col-lg-4 col-md-4 col-xs-10">
          <div class="form-group">
                  <label for="Nombre">Nombre</label>
                  <input type="text" class="form-control" placeholder="Ingresa el nombre de la empresa" name="nombre" value="'.$nomb.'" required>
                </div>
                </div>
                <!-- /.Nombre de Empresa -->
                 
                 <!-- Telefono Empresa -->
          <div class="col-lg-4 col-md-4 col-xs-10">
          <div class="form-group">
                  <label for="telefono">Telefono</label>
                  <input type="text" class="form-control telf" placeholder="Ingresa el telefono" name="telefono" value="'.$row['telf'].'" required>
          <input type="hidden" name="id" value="'.$row['id_proveedor'].'" required>
                </div>
                </div>
                <!-- /.Telefono Empresa -->
                    <!-- Correo -->
                <div class="col-lg-4 col-md-4 col-xs-10">
                <div class="form-group">
                  <label for="Direccion">Correo Electronico</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingresa el Correo electronico" required name="correo" value="'.$row['correo'].'">
                </div>
                </div>
               <!-- /.Correo -->
<!-- Direccion -->
          <div class="col-lg-12 col-md-12 col-xs-10">
          <div class="form-group">
                  <label for="Direccion">Direcci&oacute;n</label>
                  <textarea class="form-control" placeholder="Direccion del cliente" name="direccion" required>'.$row['direccion'].'</textarea>
                </div>
                </div>
                <!-- /.Direccion -->
                <!-- Observacion -->
          <div class="col-lg-12 col-md-12 col-xs-10">
          <div class="form-group">
                  <label for="Observacion">Observaci&oacute;n*</label>
                  <textarea class="form-control" placeholder="Observaci&oacute;n" name="observacion">'.$row['observacion'].'</textarea>
                </div>
                </div>
                <!-- /.Direccion -->
                <div class="col-lg-12 col-md-4 col-xs-12 text-center">
                <div class="checkbox">
                  <label>
                    Campos con (*) son opcionales
                  </label>
                </div>
              </div>
              <!-- /.box-body -->
         <div class="box-footer text-center">
          <div class="col-lg-6 col-md-6 col-xs-6 text-center">
                <button type="submit" id="ref" class="btn btn-primary">Actualizar Informaci&oacute;n</button>              
            </form>
            </div>

             <div class="col-lg-6 col-md-6 col-xs-6 text-center">
            <form id="formulario2" role="form" method="POST" enctype="multipart/form-data" action="pro_eliminar_proveedor.php">
            <input type="hidden" name="id_proveedor" value="'.$row['id_proveedor'].'">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Eliminar Proveedor</button>
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
        <p>Eliminar Proveedor?</p><h5>'.$row['rif'].'&nbsp;'.$row['nombre'].'&nbsp;'.$row['correo'].'&nbsp;'.$row['direccion'].'.</h5>
     

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Eliminar Proveedor</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>
            </form>
            </div>
            </div>
          </div>
         ';
      echo "<div id='clearfix'></div>"; 
}
$consult=("SELECT * FROM inventario WHERE id_proveedor='$id_proveedor' AND habilitado=0  GROUP BY(n_factura)");
$fv=cons($consult);
if(mysqli_num_rows($fv)>=1){
	 echo '<div class="box">
            <div class="box-header text-center">
              <h3 class="box-title">Articulos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Numero de Factura</th>
				  <th>Fecha</th>
                  <th>Articulos de la Factura</th>
                </tr>
                </thead>
                <tbody id="prep">
               ';
while($ro=mysqli_fetch_array($fv)){
	$numero_factura=$ro['n_factura'];
	echo '<tr>
	<td><a href="facturas.php?n_fac='.$numero_factura.'&id_proveedor='.$id_proveedor.'">'.$numero_factura.'</a></td>
	<td>'.$ro['fecha'].'</td>';
	$coq=("SELECT * FROM inventario WHERE n_factura='$numero_factura' AND id_proveedor='$id_proveedor' AND habilitado=0");
	$vq=cons($coq);
	$cantidadq=mysqli_num_rows($vq);
	echo "<td>".$cantidadq."</td>";
	echo '</tr>';
}
	  echo ' </tbody>
                <tfoot>
                <tr>
           <th>Numero de Factura</th>
				  <th>Fecha</th>
                  <th>Articulos de la Factura</th>
                  
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>'; 
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
<?php $conectar=TRUE; include("conexion.php");
?>
<script src="jquery.maskedinput.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
$(".telf").mask("(9999) 9999-999");
});
</script>
<script>
$(document).ready(function(){
$('.agregar').click(function() {
	
  // Enviamos el formulario usando AJAX
  var codigo_pieza = $("#codigo_pieza").val();
  var cantidad = $("#cantidad").val();

        $.ajax({
			async: true,   
            type: 'POST',
            url: 'verificar_pieza_factura.php',
            data: {codigo_pieza:codigo_pieza,cantidad:cantidad},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#more').append(data);
		
            }
        })        
        return false;
  
    }); 
}); 	
</script>
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<?php
if(isset($_SESSION['ingreso'])){
	if(isset($_POST['tip'])){
	if(isset($_POST['dni'])){
	$id_tipo=filtroxss($_POST['tip']);
	$dni=filtroxss($_POST['dni']);
  if ($id_tipo==11) {
    $ml="si";
  }
	$consulta=("SELECT * FROM cliente WHERE id_tipo='$id_tipo' AND dni='$dni' AND habilitado=0 LIMIT 1");
	$f=cons($consulta);
	if(mysqli_num_rows($f)<=0){

echo ' <div class="col-lg-4 col-md-4 col-xs-10">
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

                <!-- Correo -->
                <div class="col-lg-4 col-md-4 col-xs-10">
                <div class="form-group">
                  <label for="Correo">Correo Electronico</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingresa el Correo electronico" required name="correo">
                </div>
                </div><hr style="width: 100%; color: black; height: 0.5px; background-color:#3c8dbc;" />
                <!-- /. Correo -->
                <!-- Direccion -->
          <div class="col-lg-12 col-md-12 col-xs-10">
					<div class="form-group">
                  <label for="Direccion">Direcci&oacute;n</label>
                  <textarea class="form-control" placeholder="Direccion del cliente" name="direccion" required></textarea>
                </div>
                </div>
                <!-- /. Direccion -->

                

                <!-- Imagen de DNI -->
                <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-group">
                  <label for="imagen documento">Documento De Identidad *</label>
                  <input type="file" name="cedula" id="exampleInputFile">
                </div>
                </div>
                <!-- /. Imagen de DNI -->

              <!-- Imagen de Carnet -->
              <div class="col-lg-6 col-md-6 col-xs-12">
  				    <div class="form-group">
                  <label for="Carnet Circulacion">Carnet De Circulacion *</label>
                  <input type="file" name="carnet" id="exampleInputFile">
                </div>
                </div><hr style="width: 100%; color: black; height: 1px; background-color:#3c8dbc;" />
              <!-- /. Imagen de Carnet --><div class="col-lg-12 col-md-12 col-xs-12 text-center">
                <div class="checkbox">
                  <label>
                    Campos con (*) son opcionales
                  </label>
                </div>
              </div>';



}else{
	while($row=mysqli_fetch_array($f)){
			echo '<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Nombre">Nombre</label>
                  <input type="text" class="form-control" placeholder="Ingresa el nombre del cliente" value="'.$row['nombre'].'" name="nombre" required readonly>
				  <input type="hidden" name="id_cliente" value="'.$row['id_cliente'].'" required>
                </div>
                </div>';
            }

}

echo '<div class="col-lg-6 col-md-6 col-xs-10">
					<div class="form-group">
                  <label for="Nombre">Codigo De Pieza</label>
                  <select type="text" id="codigo_pieza"  class="form-control select2" style="width: 100%;" placeholder=Codigo De Pieza" name="codigo_pieza" required>';
$consulta=("SELECT * FROM pieza;");
$pr=cons($consulta);
while($t=mysqli_fetch_array($pr)){
$id_pieza=$t['id_pieza'];
echo "<option value=".$t['codigo_pieza'].">".$t['nombre']."&nbsp;".$t['codigo_pieza']."&nbsp;(".cantidad($id_pieza).")</option>";
}      
echo '</select>
                </div>
                </div>
				<div class="col-lg-4 col-md-4 col-xs-10">
				<div class="form-group">
        <label for="Documento">Cantidad</label>
           <div class="input-group">
                <input type="text"  id="cantidad"  class="form-control" placeholder="Ingresa la cantidad" name="cantidad" maxlength="15">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat agregar">Agregar</button>
                    </span>
              </div></div></div>';







	}
}
}
?>
<script src="plugins/select2/select2.full.min.js"></script>
<script>
$(function () {
    //Initialize Select2 Elements
$(".select2").select2();
});
</script>
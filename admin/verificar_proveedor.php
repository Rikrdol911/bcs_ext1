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
  var precio = $("#precio").val();

        $.ajax({
			async: true,   
            type: 'POST',
            url: 'verificar_pieza.php',
            data: {codigo_pieza:codigo_pieza,cantidad:cantidad,precio:precio},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#more').append(data);
				
            }
        })        
        return false;
  
    }); 
}); 	
</script>
<style type="text/css">
.error{
  border: solid 5px #CC1616!important;
  box-shadow: 0 0 8px #cc1616;
  color:#cc1616!important;
}
#error{
  margin-left:12px;
  color:#cc1616;
  font-weight:bold;
  display:none;
}
.suggest-element{
margin-left:5px;
margin-top:5px;
width:350px;
cursor:pointer;
}
#suggestions {
width:350px;
height:150px;
overflow: auto;
display: none;
}
</style> 
<?php
if(isset($_SESSION['ingreso'])){
		if(isset($_POST['dni'])){
      if(isset($_POST['tipo'])){
$tipo=$_POST['tipo']; 
$dni=$_POST['dni'];
}
$consulta=("SELECT * FROM proveedor WHERE rif='$dni' AND id_tipo='$tipo' AND habilitado=0 LIMIT 1");
	$f=cons($consulta);
	if(mysqli_num_rows($f)<=0){
		echo '<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Nombre">Nombre</label>
                  <input type="text" class="form-control" placeholder="Ingresa el nombre del proveedor" name="nombre" required>
                </div>
                </div>
                <!-- /. Nombre de Cliente -->

                <!-- Telefono Clinte -->
                <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Tel&eacute;fono</label>
                  <input type="text" maxlength="11" class="form-control telf" placeholder="Ingresa el telefono celular" name="telefono" required="required">
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
                  <label for="Correo">Correo Electronico</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingresa el Correo electronico" required name="correo">
                </div>
                </div>

				<div id="clearfix"></div>

         
                <div class="col-lg-4 col-md-4 col-xs-10">
                <div class="form-group">
                  <label for="Correo">Observacion*</label>
                  <textarea class="form-control" placeholder="Observaciones" name="observacion"></textarea>
                </div>
                </div>
                  <hr style="width: 100%; color: black; height: 1px; background-color:#808080;" />
                  <div class="col-lg-4 col-md-4 col-xs-10">
                <div class="form-group">
                  <label for="Fecha">Fecha Seg&uacute;n Fact.</label>
                  <input type="date" class="form-control pull-right" placeholder="Fecha" id="fecha" name="fecha">

                </div>
                </div>
                 <div class="col-lg-4 col-md-4 col-xs-10">
                <div class="form-group">
                  <label for="n_factura">N Fact.</label>
                  <input type="text" class="form-control" placeholder="Factura Proveedor" id="n_factura" name="n_factura">
                </div>
                </div>
				<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Nombre">Codigo De Pieza</label>
                  <input type="text" id="codigo_pieza"  class="form-control" placeholder=Codigo De Pieza" name="codigo_pieza">
                <div id="suggestions" class="form-control"></div>
                  <span id="error"></span></p>
                </div>
                </div>
				<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Nombre">Cantidad</label>
                  <input type="number" id="cantidad" class="form-control" placeholder="Ingresa la cantidad" name="cantidad" min="1">
                </div>
                </div>
				 <div class="col-lg-4 col-md-4 col-xs-10">
				<div class="form-group">
        <label for="Documento">Precio Unitario</label>
           <div class="input-group">
                <input type="text"  id="precio"  class="form-control" placeholder="Ingresa el precio unitario" name="precio" maxlength="15">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat agregar">Agregar</button>
                    </span>
              </div></div></div>
				';
	}else{
		while($rt=mysqli_fetch_array($f)){
		echo ' <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Nombre">Nombre</label>
                  <input type="text" class="form-control" placeholder="Ingresa el nombre del proveedor" name="nombre" value="'.$rt['nombre'].'" required readonly>
                </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-10">
                <div class="form-group">
                  <label for="Fecha">Fecha Seg&uacute;n Fact.</label>
                  <input type="date" class="form-control" placeholder="Fecha" id="fecha" name="fecha">

                </div>
                </div>

                 <div class="col-lg-4 col-md-4 col-xs-10">
                <div class="form-group">
                  <label for="n_factura">N Fact.</label>
                  <input type="text" class="form-control" placeholder="Factura Proveedor" id="n_factura" name="n_factura">
                </div>
                </div>
<div class="col-lg-4 col-md-4 col-xs-10">
          <div class="form-group">
                  <label for="Nombre">Codigo De Pieza</label>
                  <input type="text" class="form-control" placeholder="Codigo De Pieza" id="codigo_pieza" name="codigo_pieza">
                <div id="suggestions" class="form-control"></div>
                  <span id="error"></span></p>
                </div>
                </div>
				<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Nombre">Cantidad</label>
                  <input type="number" class="form-control" placeholder="Ingresa la cantidad" id="cantidad" name="cantidad" min="1">
                </div>
                </div>
				 <div class="col-lg-4 col-md-4 col-xs-10">
				<div class="form-group">
        <label for="Documento">Precio Unitario</label>
           <div class="input-group">
                <input type="text" class="form-control" placeholder="Ingresa el precio unitario" id="precio" name="precio" maxlength="15">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat agregar">Agregar</button>
                    </span>
              </div></div></div>
				';
			
		}
	}
		}
}

?>
<script type="text/javascript">
$(document).ready(function() {    
    //Al escribr dentro del input con id="service"
    $('#codigo_pieza').keypress(function(){
        //Obtenemos el value del input
        var service = $(this).val();        
        var dataString = 'service='+service;
        $("#suggestions").removeAttr("display") 
        //Le pasamos el valor del input al ajax
        $.ajax({
            type: "POST",
            url: "autocomplete.php",
            data: dataString,
            success: function(data) {
                //Escribimos las sugerencias que nos manda la consulta
                $('#suggestions').fadeIn(900).html(data);
                //Al hacer click en algua de las sugerencias
                $('.suggest-element').on('click', function(){
                    //Obtenemos la id unica de la sugerencia pulsada
                    var id = $(this).attr('id');
                    //Editamos el valor del input con data de la sugerencia pulsada
                    $('#codigo_pieza').val($('#'+id).attr('data'));
                    //Hacemos desaparecer el resto de sugerencias
                    $('#suggestions').fadeOut(100);
                }); 

            }

        });

    });                 
});    
</script>
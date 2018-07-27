<?php $conectar=TRUE; include("conexion.php");
?>
<script src="jquery.maskedinput.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
$(".telf").mask("(9999) 9999-999");
});
</script>
<?php
if(isset($_SESSION['ingreso'])){
	if(isset($_POST['tip'])){
	if(isset($_POST['dni'])){
	$id_tipo=filtroxss($_POST['tip']);
	$dni=filtroxss($_POST['dni']);
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
                  <input type="text" class="form-control telf" placeholder="Ingresa el telefono celular" name="telefono" required>
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
                </div><hr style="width: 100%; color: black; height: 0.5px; background-color:#3c8dbc;" />
                <!-- /. Correo -->

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
              <!-- /. Imagen de Carnet -->

  <div class="col-lg-4 col-md-4 col-xs-10">
			    <div class="form-group">
                  <label for="Tipo de Documento">Marca</label>
                  <select class="form-control" name="id_marca" required>';
$consultaaa=("SELECT * FROM marca");
$daa=cons($consultaaa);
while($rowaa=mysqli_fetch_array($daa)){
echo "<option value=".$rowaa['id_marca'].">".$rowaa['nombre']."</option>";	
}
              echo '</select>
                </div>
                </div>
 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">VIN</label>
                  <input type="text" class="form-control" placeholder="Ingresa el VIN" name="vin" required>
                </div>
                </div>
 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Modelo</label>
                  <input type="text" class="form-control" placeholder="Ingresa el Modelo del vehiculo" name="modelo" required>
                </div>
                </div>
 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Serial Del Motor*</label>
                  <input type="text" class="form-control" placeholder="Ingresa el Serial del motor" name="serial_motor">
                </div>
                </div>
				 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">A&ntilde;o</label>
                  <input type="text" maxlength="5" class="form-control" placeholder="Ingresa el a&ntilde;o del vehiculo" name="ano" required>
                </div>
                </div>
				
				 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Placa</label>
                  <input type="text" class="form-control" placeholder="Ingresa la placa del vehiculo" name="placa" required>
                </div>
                </div>
 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Color</label>
                  <input type="text" class="form-control" placeholder="Ingresa el color del vehiculo" name="color" required>
                </div>
                </div>
				 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Cilindrada</label>
                  <input type="text" class="form-control" placeholder="Ingresa el Cilindrada del vehiculo" name="cilindro" required>
                </div>
                </div>
				 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Caja</label>
                  <select class="form-control" name="caja" required>
				  <option>Automatica</option>
				  <option>Manual</option>
				  <option>Dual</option>
				  </select>
                </div>
                </div>
				<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Valvula</label>
                  <input type="text" class="form-control" placeholder="Ingresa ña valvula del vehiculo" name="valvula" required>
                </div>
                </div>
				<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Nombre del contacto</label>
                  <input type="text" class="form-control" placeholder="Ingresa el nombre del contacto" name="nombre_contacto" required>
                </div>
                </div>
				<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Telefono De Contacto</label>
                  <input type="text" class="form-control telf" placeholder="Ingresa el Numero del contacto" name="telefono_contacto" required>
                </div>
                </div>
				
              <div class="col-lg-12 col-md-12 col-xs-12 text-center">
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
                </div>
				 <div class="col-lg-4 col-md-4 col-xs-10">
			    <div class="form-group">
                  <label for="Tipo de Documento">Marca</label>
                  <select class="form-control" name="id_marca" required>';
$consultaa=("SELECT * FROM marca");
$da=cons($consultaa);
while($rowa=mysqli_fetch_array($da)){
echo "<option value=".$rowa['id_marca'].">".$rowa['nombre']."</option>";	
}
              echo '</select>
                </div>
                </div>
 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">VIN</label>
                  <input type="text" class="form-control" placeholder="Ingresa el VIN" name="vin" required>
                </div>
                </div>
 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Modelo</label>
                  <input type="text" class="form-control" placeholder="Ingresa el Modelo del vehiculo" name="modelo" required>
                </div>
                </div>
 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Serial Del Motor*</label>
                  <input type="text" class="form-control" placeholder="Ingresa el Serial del motor" name="serial_motor">
                </div>
                </div>
				 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">A&ntilde;o</label>
                  <input type="text" maxlength="5" class="form-control" placeholder="Ingresa el a&ntilde;o del vehiculo" name="ano" required>
                </div>
                </div>
				
				 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Placa</label>
                  <input type="text" class="form-control" placeholder="Ingresa la placa del vehiculo" name="placa" required>
                </div>
                </div>
 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Color</label>
                  <input type="text" class="form-control" placeholder="Ingresa el color del vehiculo" name="color" required>
                </div>
                </div>
				 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Cilindrada</label>
                  <input type="text" class="form-control" placeholder="Ingresa el Cilindrada del vehiculo" name="cilindro" required>
                </div>
                </div>
				 <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Caja</label>
                  <select class="form-control" name="caja" required>
				  <option>Automatica</option>
				  <option>Manual</option>
				  <option>Dual</option>
				  </select>
                </div>
                </div>
				<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Valvula</label>
                  <input type="text" class="form-control" placeholder="Ingresa la valvula del vehiculo" name="valvula" required>
                </div>
                </div>
				<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Nombre del contacto</label>
                  <input type="text" class="form-control" placeholder="Ingresa el nombre del contacto" name="nombre_contacto" value="'.$row['nombre'].'" required>
                </div>
                </div>
				<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Telefono De Contacto</label>
                  <input type="text" class="form-control" placeholder="Ingresa el Numero del contacto" name="telefono_contacto" value="'.$row['telf'].'" required>
                </div>
                </div>
				
              <div class="col-lg-12 col-md-4 col-xs-12 text-center">
                <div class="checkbox">
                  <label>
                    Campos con (*) son opcionales
                  </label>
                </div>
              </div>
				
				
				';
			
		}
		
	}
	
	
	
	
	}
	}
}
?>
<?php $conectar=TRUE; include("conexion.php"); 
?>
  <script>
$(document).ready(function(){
$('.lolb').click(function() {
  // Enviamos el formulario usando AJAX
        $.ajax({
			async: true,   
            type: 'POST',
            url: 'pro_agregar_pieza_or.php',
            data: $(".formula45").serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#agregado2').prepend(data);
				
            }
        })        
        return false;
  
    }); 		
 });
</script>
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id'])){
$id_pieza=filtroxss($_POST['id']);
$consulta=("SELECT * FROM pieza WHERE codigo_pieza='$id_pieza' LIMIT 1");
$d=cons($consulta);
if(mysqli_num_rows($d)>=1){
	while($fb=mysqli_fetch_array($d)){
$nombre=$fb['nombre'];
$id_de_pieza=$fb['id_pieza'];
}
}
if (!isset($id_de_pieza)) {
  echo "<br>";
  echo negativo("No se encuentra la pieza");
  exit;
}
$er=("SELECT * FROM inventario WHERE id_pieza='$id_de_pieza' LIMIT 1");
$r=cons($er);
while($gb=mysqli_fetch_array($r)){
  $precio=$gb['precio'];
}if (!isset($precio)) {
  $precio="";
}else{
  $precio=$gb['precio'];
}
	$id_or=filtroxss($_POST['id_or']);

echo '<br><div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Selecciona</h3>
              <div class="box-tools pull-right">
                   
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="formula45" action="pro_agregar_pieza_or.php" method="POST">
              <div class="box-body">
              <div class="col-lg-10 col-md-10 col-xs-10">
              <div class="form-group">
                <label>Pieza de Cliente&nbsp;&nbsp;
                    <input type="checkbox" name="taller" value="1">
                  </label>
                  </div>
                   </div>

                <div class="col-lg-6 col-md-6 col-xs-10">
                <div class="form-group">
                  <label for="exampleInputEmail1">Pieza</label>
                  <input type="text" readonly class="form-control" id="exampleInputEmail1" name="nombre" value="'.$nombre.'">
                </div>
                 </div>
                  <div class="col-lg-5 col-md-5 col-xs-10">
                <div class="form-group">
                  <label for="exampleInputPassword1">Precio</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="precio" value="'.$precio.'">
                  <input type="hidden" class="form-control" id="exampleInputPassword1" name="id_or" value="'.$id_or.'">
                  <input type="hidden" class="form-control" id="exampleInputPassword1" name="id_pieza" value="'.$id_de_pieza.'">
                </div>
                 </div>
                   <div class="col-lg-3 col-md-3 col-xs-10">
              <div class="form-group">
                  <label for="exampleInputPassword1">Cantidad - Disponible ('.cantidad($id_de_pieza).')</label>
                  <input type="number" class="form-control" id="exampleInputPassword1" name="cantidad" value="1" min="1">
                </div>  
                </div>'; 

                echo '</div>
              <!-- /.box-body -->
              <div class="col-md-12 col-lg-12 col-xs-10 text-center">
                <button type="submit" class="btn btn-primary lolb">Agregar</button>
              </div>
            </form>
          </div>';





}
}
?>
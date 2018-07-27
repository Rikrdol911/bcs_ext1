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
        <li><a href="ver_pieza.php"><i class="fa fa-dashboard"></i> Volver</a></li>
        <li class="active">Editar Piza</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
<section class="content">
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_GET['id'])){
$id_pieza=filtroxss($_GET['id']);
$consulta=("SELECT * FROM pieza WHERE id_pieza='$id_pieza' AND habilitado=0 LIMIT 1");
$f=cons($consulta);
if(mysqli_num_rows($f)<=0){
echo alerta("No existe la pieza");	
}else{
while($row=mysqli_fetch_array($f)){
$nombre_pieza=$row['nombre'];
$id_rango_pieza=$row['id_rango'];
$codigo_pieza=$row['codigo_pieza'];
$consultaa=("SELECT * FROM rango WHERE id_rango='$id_rango_pieza'");
$da1=cons($consultaa);
while($rowa1=mysqli_fetch_array($da1)){
$nombre_rango_pieza=$rowa1['nombre'];
}
echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><b>'.$nombre_rango_pieza.'&nbsp;'.$nombre_pieza.'</b></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form id="formulario" role="form" method="POST" enctype="multipart/form-data" action="pro_actualizar_pieza.php">
            <input type="hidden" class="form-control" name="id_pieza" value="'.$id_pieza.'">
              <div class="box-body">
          <!-- Documento nombre_pieza -->
          <div class="col-lg-6 col-md-6 col-xs-10">
			    <div class="form-group">
                  <label for="Nombre Pieza">Nombre Pieza</label>
                  <input type="text" class="form-control" name="nnombre_pieza" value="'.$nombre_pieza.'" required>
                  </div></div>
                    <!-- Codigo Pieza -->
          <div class="col-lg-6 col-md-6 col-xs-10">
			    <div class="form-group">
                  <label for="codigo_pieza">Codigo Pieza</label>
                  <input type="text" class="form-control" name="ncodigo_pieza" value="'.$codigo_pieza.'" required>
                  </div></div>
                   
                   <!-- Rango -->
          <div class="col-lg-5 col-md-5 col-xs-10">
			    <div class="form-group">
                  <label for="Rango">Rango</label>
                  <select class="form-control" name="nid_rango" required>';
echo "<option selected value='".$id_rango_pieza."'>".$nombre_rango_pieza."</option>";
$consultaa=("SELECT * FROM rango");
$da=cons($consultaa);
while($rowa=mysqli_fetch_array($da)){
$id_rango=$rowa['id_rango'];
$nombre_rango=$rowa['nombre'];
echo "<option selected value=".$id_rango.">".$nombre_rango."</option>";

}
              echo '</select>
                </div>
                </div>
                </div> 
                <div class="box-footer text-center"><button action="submit" class="btn btn-info">Actualizar Pieza</button></div></form></div>';
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
}
}
include("footer.php");
?>
<script>
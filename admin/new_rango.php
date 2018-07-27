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
              <h3 class="box-title">Registrar Rango</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->            
            <!-- form start -->
            <form id="formulario" role="form" method="POST" enctype="multipart/form-data" action="pro_registrar_rango.php">
              <div class="box-body">

          <!-- Documento Nacional de Identidad -->
          <div class="col-lg-12 col-md-12 col-xs-12">
			    <div class="form-group">
                  <label for="Nombre Rango">Nombre de Rango</label>
                  <input class="form-control" name="nombre_rango" placeholder="Nombre del Rango" maxlength="60" required>
                  </div>
                  </div>
                   </div>
                  <!-- Btn Envio -->
              <div class="box-footer text-center">
                <button type="submit" id="ref" class="btn btn-primary">Registrar Rango</button>
              </div>
              <!-- /.btn envio -->

            </form>
            <!-- /.formulario cliente -->
          </div>';
echo "<div id='clearfix'></div>";
		  $consult=("SELECT * FROM rango");
		  $d=cons($consult);
		  echo '<div class="box box-danger">
            <div class="box-header with-border text-center">
              <h3 class="box-title">Rangos Registrados</h3>
              </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th> 
                </tr>
                </thead>
                <tbody id="prep">
               ';
		  while($fg=mysqli_fetch_array($d)){
		  	$id_rangos=$fg['id_rango'];
			  $rangos=$fg['nombre'];				  
			  echo ' <tr>
                  <td>'.$rangos.'</td>  
                </tr> ';
			  
			  }
			  echo ' </tbody>
                <tfoot>
                <tr>
                  <th>Nombre</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>';
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
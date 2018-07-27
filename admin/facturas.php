<?php include("menu.php");
?>
 <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
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
        <li class="active">Ver Factura</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_GET['n_fac'])){
if(isset($_GET['id_proveedor'])){

$id_proveedor=filtroxss($_GET['id_proveedor']);
$n_factura=filtroxss($_GET['n_fac']);	
echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Factura #'.$n_factura.'</b></h3>
            </div>';
			$consu=("SELECT * FROM proveedor WHERE id_proveedor='$id_proveedor' LIMIT 1");
			$dv=cons($consu);
			while($ro=mysqli_fetch_array($dv)){
      $id_tipo=$ro['id_tipo'];
			$nombre_proveedor=$ro['nombre'];
			$rif=$ro['rif'];	
			$telefono=$ro['telf'];	
      $consu2=("SELECT * FROM tipo WHERE id_tipo='$id_tipo' LIMIT 1");
      $dv2=cons($consu2);
      while($ro2=mysqli_fetch_array($dv2)){
        $nombre_tipo=$ro2['nombre'];
      }
			}
			echo "<div class='box-body'>Proveedor: <b><a href='perfil_proveedor.php?id=".$id_proveedor."'>".$nombre_proveedor."</a></b><br>RIF: <b>".$nombre_tipo."-".$rif."</b><br>Telefono: <b>".$telefono."</b><br><br>";
$consulta=("SELECT * FROM inventario WHERE id_proveedor='$id_proveedor' AND n_factura='$n_factura' AND habilitado=0");
$f=cons($consulta);
if(mysqli_num_rows($f)<=0){
echo alerta("No existe la factura");	
}else{
	echo '<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID Inventario</th>
                  <th>Rango</th>
                  <th>Pieza</th>
                  <th>Fecha</th>
                  <th>Cantidad</th>
				  <th>Precio Bs</th>
				  <th>Total Bs</th>
                </tr>
                </thead>
                <tbody id="prep">';
				$total_factura=0;
	while($row=mysqli_fetch_array($f)){
		$id_pieza=$row['id_pieza'];
    $fecha1=$row['fecha'];  
		$fc=("SELECT * FROM pieza WHERE id_pieza='$id_pieza' LIMIT 1");
		$v=cons($fc);
		while($ts=mysqli_fetch_array($v)){
			$id_rango=$ts['id_rango'];
			$nombre_pieza=$ts['nombre'];
		}
		
		$cons=("SELECT * FROM rango WHERE id_rango='$id_rango' LIMIT 1");
		$d=cons($cons);
		while($tg=mysqli_fetch_array($d)){
		$nombre_rango=$tg['nombre'];	
		}
		echo '<tr>
		<td>'.$row['id_inventario'].'</td>
		<td>'.$nombre_rango.'</td>
		<td>'.$nombre_pieza.'</td>
		<td>'.$row['fecha'].'</td>
		<td>'.$row['cantidad'].'</td>
		<td>'.$row['precio'].'</td>
		<td>'.number_format(($row['cantidad']*$row['precio']),2,",",".").'</td>
		</tr>';
		$total_factura=$total_factura+($row['cantidad']*$row['precio']);
	 
	}
	echo ' </tbody>
                <tfoot>
                <tr>
                    <th>ID Inventario</th>
                  <th>Rango</th>
                  <th>Pieza</th>
                  <th>Fecha</th>
                  <th>Cantidad</th>
				  <th>Precio Bs</th>
				  <th>Total Bs</th>
                </tr>
                </tfoot>
              </table>';
			  echo "<h3>TOTAL DE FACTURA: ".number_format($total_factura,2,",",".")." Bs</h3>";
}

echo "<hr>
<div class='text-center'>
<form action='pro_eliminar_factura.php' method='POST' id='formulario'>
<input type='hidden' name='id_proveedor' value='".$id_proveedor."' required>
<input type='hidden' name='n_factura' value='".$n_factura."' required>
<input type='hidden' name='fecha' value='".$fecha1."' required>
<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#myModal'>Eliminar</button>";
echo '<div id="myModal" class="modal fade col-lg-offset-1 col-md-offset-1 col-xs-offset-0" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Desea Realizar la Operaci&oacute;n?</h3>
      </div>
      <div class="modal-body">
        <p>Eliminar Factura?</p><h5>N° Fact:&nbsp;'.$n_factura.'&nbsp;'.$row['fecha'].'&nbsp;'.$nombre_tipo.'-'.$rif.'&nbsp;'.$nombre_proveedor.'.</h5>
     <p>Introdusca el n&uacute;mero de factura para confirmar:</p>
        <input type="text" name="facconf" class="form-control" placeholder="N&uacute;mero de Factura" maxlength="15" required>
     

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Eliminar Factura</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
</form>
</div>
</div>';

}
}
}
include("footer.php");
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
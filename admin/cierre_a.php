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
        <li class="active">A&ntilde;o Fiscal</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
?>
            <!-- box-header -->
<div class="box box-primary collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Buscar por Fechas</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="formulario" role="form" method="GET" enctype="multipart/form-data" action="rango_fiscal.php">
              <div class="box-body">
                       <!-- Date range -->
              <div class="col-lg-10 col-md-10 col-xs-10">
              <div class="form-group col-md-offset-2">
                <label>Buscar por Rango: </label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation" name="a_fecha">
                </div>
                <!-- /.input group -->
              </div>
              </div>
                <!-- /.Date range -->
              </div>
              <!-- Btn Envio -->
              <div class="box-footer text-center">
                <button type="submit" id="ref2" class="btn btn-primary">Buscar</button>
              </div>
              <!-- /.btn envio -->
              </form>
              <!-- form end -->
              </div>
<div class="box box-danger">
            <div class="box-header with-border text-center">
              <h3 class="box-title">Cerrar A&ntilde;o</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form action="pro_cierre_a.php" method="post" id="form_a">
            <div class="col-lg-offset-5 col-md-offset-5 col-xs-offset-4">
             <div class="input-group text-center">
             <p>Cerrar:
             <button type="button" name="cerrar" class="btn btn-flat" data-toggle="modal" data-target="#myModalfiscal">Cerrar A&ntilde;o<i class="ion-checkmark-round"></i>
                </button></p>
             </div>
             </div>
<div id="myModalfiscal" class="modal fade col-lg-offset-1 col-md-offset-1 col-xs-offset-0  bs-example-modal-lg" role="dialog">
  <div class="modal-dialog">
   <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Alerta!! Todos las operaciones cerraran hasta la fecha. Desea Continuar?</h3>
      </div>
      <div class="modal-body">
      <p>Introdusca la Fecha Actual para confirmar:</p>
      <input type="date" name="fechaconf" class="form-control" axlength="30" required>
      </div>
      
      <div class="modal-footer">
      <button type="submit" class="btn btn-info">Proceder</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
        </div>
        </div>
        </div>
  </div>
   
     
            </form>
            </div>


<!-- date-range-picker -->
<script src="plugins/daterangepicker/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<?php 
}
include("footer.php");
?>
<script>
$(document).ready(function(){
  $(function () {

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );
  });
    });
</script>
<script>
  $(document).ready(function(){
        $("#form_a").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("form_a"));
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
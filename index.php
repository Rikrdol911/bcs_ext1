<?php $conectar=TRUE; include("admin/conexion.php");?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bosch Car Service Extesi&oacute;n 1</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="#">
  <!-- Ionicons -->
  <link rel="stylesheet" href="#">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="admin/plugins/iCheck/square/yellow.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery 2.2.3 -->
<script src="admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>
$(document).ready(function(){
$('#form_sign').submit(function() {
 
  // Enviamos el formulario usando AJAX

        $.ajax({
			async: true,   
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#respuesta').html(data);
            }
	})       
        return false; 
    }); 
});

</script>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  
   <b>RenaP</b>arts
   <h5>Ventas<br><a href="../../bcs/index.php" class="">Extensi&oacute;n</a></h5>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Iniciar Sesion</p>
<?php 
if(!isset($_SESSION['ingreso'])){
echo '    <form action="pro_inicio.php" method="post" id="form_sign">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="clave" placeholder="Clave" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        
        </div>
        <!-- /.col -->
     
          <button type="submit" class="btn btn-warning btn-block btn-flat">Ingresar</button>
       <div class="col-lg-12 col-xs-12"><br><br>
<div id="respuesta" class="text-center"></div></div>
      </div>
        <!-- /.col -->
      </div>
    </form>';
}else{
	
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin/index.php">';
	   ?>
<script>
window.location.href = "admin/index.php";
</script>
<?php
}
  ?>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- Bootstrap 3.3.6 -->
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
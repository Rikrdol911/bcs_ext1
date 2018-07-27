<?php $conectar=TRUE; include("conexion.php");
?>
<style type="text/css">
td, th {
    padding: 0;
}
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
td, th {
    display: table-cell;
    vertical-align: inherit;
}
</style>
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_POST['codigo_pieza'])){
if(isset($_POST['cantidad'])){
if(isset($_POST['precio'])){
$clase='btn btn-block btn-danger elim';
$codigo=filtroxss($_POST['codigo_pieza']);
$cantidad=filtroxss($_POST['cantidad']);
$precio=filtroxss($_POST['precio']);
if (($codigo=="") || ($cantidad=="") || ($precio=="")) {
	echo negativo("Debes ingresar los campos requeridos");
	exit;
}
$rand=rand();
$consulta=("SELECT * FROM pieza WHERE codigo_pieza='$codigo' AND habilitado=0 LIMIT 1");
$sd=cons($consulta);
if(mysqli_num_rows($sd)<=0){
$var="a".$rand;
$v2="c".$rand;
	$col=("SELECT * FROM rango WHERE habilitado=0");
	$s=cons($col);
	$se="<select id=".$v2." name=".'id_rango[]'.">";
	while($fg=mysqli_fetch_array($s)){
		$se=$se."<option value=".$fg['id_rango']."><small>".$fg['nombre']."</small></option>";
	}
	$se=$se."</select>";
$tabla="<tr class=".$var."><td><small><input class=".$v2." value=".$codigo." type=".'text'." name=".'codigo_pieza[]'."></small></td><td><input class=".$v2." placeholder=".'Nombre de la pieza'." type=".'text'." name=".'nombre_pieza[]'." required></td><td>".$se."</td><td><input class=".$v2." type=".'text'." value=".$precio." name=".'precio[]'."></td><td><input class=".$v2." type=".'text'." value=".$cantidad." name=".'cantidad[]'."></td><td>".number_format(($precio*$cantidad),2,",",".")."</td><td><button type=".'button'." ps=".$rand." class=".'elim'." >x</button></td></tr>";
?>
<script>
$('#la_tabla tr:last').after('<?php echo $tabla;?>');
</script>
<?php
}else{
while($row=mysqli_fetch_array($sd)){
$id_rango=$row['id_rango'];
$nombre=$row['nombre'];
$codigo_pieza=$row['codigo_pieza'];
$consult=("SELECT * FROM rango WHERE id_rango='$id_rango' AND habilitado=0 LIMIT 1");
$fv=cons($consult);
while($ty=mysqli_fetch_array($fv)){
$nombre_rango=$ty['nombre'];	
}
$campos="<div class='c".$rand."'>
<input  type='hidden' name='codigo_pieza[]' value='".$codigo_pieza."'>
<input  type='hidden' name='nombre_pieza[]' value='".$nombre."'>
<input  type='hidden' name='id_rango[]' value='".$id_rango."'>
<input  type='hidden' name='precio[]' value='".$precio."'>
<input  type='hidden' name='cantidad[]' value='".$cantidad."'>
";	
echo $campos;
$var="a".$rand;
$tabla="<tr class=".$var."><td><small>".$codigo."<small></td><td>".$nombre."</td><td>".$nombre_rango."</td><td>".number_format($precio,2,",",".")." Bs</td><td>".$cantidad."</td><td>".number_format(($precio*$cantidad),2,",",".")." Bs</td><td><button type=".'button'." ps=".$rand." class=".'elim'." >x</button></td></tr>";
$vacio="";
?>

<script>
$(document).ready(function(){
$("#codigo_pieza").val("<?php echo $vacio;?>");
$("#cantidad").val("<?php echo $vacio;?>");
$("#precio").val("<?php echo $vacio;?>");
});
$('#la_tabla tr:last').after('<?php echo $tabla;?>');
</script>
<?php
}
}


}
}
}
}
?>
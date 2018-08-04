<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$selstatus = array('' =>'Seleccione Estatus' ,'t' =>'Activa' ,'f'=>'Inactiva' );
if (isset($datos)) {
	$id = $datos[0]->mn_id_moneda_a_pk;
	$prefijo =$datos[0]->mn_prefijo_a;
	$descripcion =$datos[0]->mn_descripcion_a;
	$status =$datos[0]->mn_estatus_b;
	$target='moneda/editarMoneda/'.$id;
	$boton = "Modificar Registro";
} else {
	$target='moneda/insertarMoneda';
	$id = set_value('id');
	$prefijo =set_value('prefijo');
	$descripcion =set_value('descripcion');
	$status =set_value('status');
	$boton = "Nueva Moneda";
}
?>
<div class="container">
	<div class="col-md-6 center-block no-float">	
		<div class="panel panel-success">
		  <div class="panel-heading" align="center">
		    <h3 class="panel-title" ><?php echo $panel_title; ?></h3>
		  </div>
		  <div class="panel-body" align="center">
		    <?php  if (validation_errors()) { echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>'; }  ?> 
		    <div id="message"></div>
		    <?php echo form_open($target); ?> 
		    <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control" id="id" >
		  <div class="form-group" align="left">
		    <label for="txprefijo">Prefijo Moneda</label>
		    <input type="text" name="prefijo" value="<?php echo $prefijo; ?>" class="form-control" id="prefijo" placeholder="Prefijo de Moneda, USD, EU..." >
		  </div>
		  <div class="form-group" align="left">
		    <label for="tsdescripcion">Descripcion de la Moneda</label>
		    <input type="text" name="descripcion" value="<?php echo $descripcion; ?>" class="form-control" id="descripcion" placeholder="Descripcion de la moneda" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="selstatus">Estatus de Moneda</label>
		    <?php echo form_dropdown('status',$selstatus,$status,'class="form-control"'); ?>
		  </div>
		  <button type="submit" class="btn btn-success"><?php echo $boton ?></button>
			<?php echo form_close(); ?> 
		  </div>
		</div>
	
	</div>
</div>


<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$selstatus = array('' =>'Seleccione Estatus' ,'t' =>'Activa' ,'f'=>'Inactiva' );
if (isset($datos)) {
	$id = $datos[0]->fe_id_fee_n_pk;
	$porcentaje = $datos[0]->fe_porcentaje_fee_n;
	$descripcion = $datos[0]->fe_descripcion_fee;
	$status =$datos[0]->fe_estatus_b;
	$target='fee/editarFee/'.$id;
	$boton = "Modificar Registro";
} else {
	$target='fee/insertarFee';
	$id = set_value('id');
	$porcentaje =set_value('porcentaje');
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
		    <label for="txporcentaje">Porcentaje de Fee</label>
		    <input type="text" name="porcentaje" value="<?php echo $porcentaje; ?>" class="form-control" id="porcentaje" placeholder="Porcentaje de Fee. Solo numero" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="tsdescripcion">Descripcion del fee</label>
		    <input type="text" name="descripcion" value="<?php echo $descripcion; ?>" class="form-control" id="descripcion" placeholder="Descripcion de la Fee" >
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


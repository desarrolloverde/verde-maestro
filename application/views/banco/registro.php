<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (isset($datos)) {
	$id = $datos[0]->bc_id_banco_a_pk;
	$entidad =$datos[0]->bc_entidad_bancaria_a;
	$coentidad =$datos[0]->bc_co_entidad_a;
	$target='banco/editarbanco/'.$id;
	$boton = "Modificar Registro";

} else {
	$target='banco/insertarbanco';
	$id=set_value('idbanco');
	$entidad=set_value('entidad');
	$coentidad=set_value('coentidad');
	$boton = "Insertar Registro";
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
		    <input type="hidden" name="idbanco" value="<?php echo $id; ?>" class="form-control" id="idbanco" >
		  <div class="form-group" align="left">
		    <label for="txentidad">Entidad Bancaria</label>
		    <input type="text" name="entidad" value="<?php echo $entidad; ?>" class="form-control" id="entidad" placeholder="Entidad Bancaria" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="txcoentidad">Codigo de Entidad Bancaria</label>
		    <input type="text" name="coentidad" value="<?php echo $coentidad; ?>" class="form-control" id="coentidad" placeholder="Codigo de entidad Bancaria ####" >
		  </div>
		  <button type="submit" class="btn btn-success"><?php echo $boton ?></button>
			<?php echo form_close(); ?> 
		  </div>
		</div>
	
	</div>
</div>


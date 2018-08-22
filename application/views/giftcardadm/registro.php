<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//.$datos(0)->tt_id_tarjeta_pk
//print_r($datos);
//echo $datos[1]->ruta;
if (isset($datos)) {
	$id = $datos[0]->gf_id_gifcard_i_pk;
	$valor =$datos[0]->gf_valor_i;
	$ruta = $datos[0]->ruta;
	$target='giftcardadm/editargiftcardadm/'.$id;
	$boton = "Modificar Registro";

} else {
	$target='giftcardadm/insertargiftcardadm';
	$id=set_value('id');
	$valor=set_value('valor');
	$ruta="";
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
		    <?php echo form_open($target,"enctype='multipart/form-data'") ?> 
		    <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control" id="id" >
		  <div class="form-group" align="left">
		    <label for="Valor">Valor de la Giftcard</label>
		    <input type="text" name="valor" value="<?php echo $valor ?>" class="form-control" id="valor" placeholder="Colocar Valor de Giftcard" >
		  </div>
		  <?php if ($ruta!="") { ?>
		  	<div class="form-group" align="left">
			    <img src="<?php echo base_url().$ruta; ?>" width='50%'>
			</div>
			<div class="form-group" align="left">
				<label for="imagen">Agregar Nueva Imagen de Giftcard</label>
				<input type="file" name="imagen"  class="form-control" id="imagen" placeholder="Seleccione imagen" >
			</div>	
		  <?php } else { ?>		  	
		  <div class="form-group" align="left">
		    <label for="imagen">Agregar imagen de Giftcard</label>
		    <input type="file" name="imagen"  class="form-control" id="imagen" placeholder="Seleccione imagen" >
		  </div>
			<?php } ?>

		  <button type="submit" class="btn btn-success"><?php echo $boton ?></button>
			<?php echo form_close(); ?> 
		  </div>
		</div>
	
	</div>
</div>

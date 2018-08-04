<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//.$datos(0)->tt_id_tarjeta_pk
//print_r($datos);
//echo $datos[0]->tt_id_tarjeta_pk;
if (isset($datos)) {
	$id = $datos[0]->tt_id_tarjeta_pk;
	$descripcion =$datos[0]->tt_descripcion_a;
	$target='franquicia/editarfranquicia/'.$id;
	$boton = "Modificar Registro";

} else {
	$target='franquicia/insertarfranquicia';
	$id=set_value('id');
	$descripcion=set_value('franquicia');
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
		    <?php echo form_open($target) ?> 
		    <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control" id="id" >
		  <div class="form-group" align="left">
		    <label for="franquicia">Nombre de Franquicia</label>
		    <input type="text" name="franquicia" value="<?php echo $descripcion ?>" class="form-control" id="franquicia" placeholder="franquicia" >
		  </div>
		  <button type="submit" class="btn btn-success"><?php echo $boton ?></button>
			<?php echo form_close(); ?> 
		  </div>
		</div>
	
	</div>
</div>
<script language="javascript" type="text/javascript">
//prueba de trabajo con json
	function registro_usuario(){
		$ajax({
			$url:<?php echo site_url('registro')?>,
			$type: 'post',
			//$datatype: 'default: Intelligent Guess (Other values: xml, json, script,html',
			$datatype: 'json'
			$data: $('#registro').serialize(),
			encode: true,
			success:function(data){
				if(!data.success){
					if(data.errors){
						$('#message').html(data.errors.addClass('alert alert-danger'));
					}
				} else {
					alert-danger(data.message);
					setTimeOut(function()) {
						window.location.reload()
					}, 400); 

				} 
			}



		})
	}

</script>

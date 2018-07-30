<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//.$datos(0)->tt_id_tarjeta_pk
//print_r($datossel1);
//echo $datos[0]->tt_id_tarjeta_pk;
if (isset($datos)) {
	$id = $datos[0]->us_id_usuario_a_pk;
	$nombre =$datos[0]->us_nombre_a;
	$apellido =$datos[0]->us_apellido_a;
	$email =$datos[0]->us_email_a;
	$rol =$datos[0]->us_id_a_pk;
	$clave =$datos[0]->us_clave_a;
	$datossel1=(array) $datossel;
	//print_r($datossel1[0]);


	$target='usuarioadm/editarusuarioadm/'.$id;
	$boton = "Modificar Registro";

} else {
	$id=set_value('id');
	$nombre =set_value('nombre');
	$apellido =set_value('apellido');
	$email =set_value('email');
	$rol =set_value('rol');
	$clave =set_value('clave');
	$datossel1=$datossel;
	$target='usuarioadm/insertarusuarioadm';
	$boton = "Insertar Registro";
}
/*
	$nombre=$this->input->post('nombre');$apellido=$this->input->post('apellido');
        		$clave=$this->input->post('clave');$email=$this->input->post('email');
        		$nurol=$this->input->post('rol');
        		us_id_usuario_a_pk, us_clave_a, us_nombre_a, us_id_a_pk, us_apellido_a, 
       us_email_a, us_estatus_b, us_fe_registro_t*/
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
		    <label for="txnombre">Nombres</label>
		    <input type="text" name="nombre" value="<?php echo $nombre ?>" class="form-control" id="nombre" placeholder="Nombres" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="txapellidos">Apellidos</label>
		    <input type="text" name="apellido" value="<?php echo $apellido ?>" class="form-control" id="apellido" placeholder="apellidos" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="txmail">Email</label>
		    <input type="text" name="email" value="<?php echo $email ?>" class="form-control" id="email" placeholder="Email formato aaaa@aa.com" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="txrol">Rol</label>
		    <select name="rol" id="rol" class="form-control">
		    	<option value="" >Seleccione Rol</option>
    	<?php  	foreach ($datossel as $row) { ?>
    			<option value="<?php echo $row->rl_id_rol_a_pk ?>" <?php echo ($row->rl_id_rol_a_pk==$rol) ? "selected=selected" : ""; ?>><?php echo $row->rl_descripcion_a ?></option>
    	<?php
    		}
    	?>
		    </select>
		<?php 	//echo form_dropdown('rol2', $datossel1, $rol); ?>
		  </div>
		  <div class="form-group" align="left">
		    <label for="txpass">Clave de Acceso</label>
		    <input type="password" name="clave" value="<?php //echo $clave ?>" class="form-control" id="clave" placeholder="Clave de acceso" >
		  </div>
		  <button type="submit" class="btn btn-success"><?php echo $boton ?></button>
			<?php echo form_close(); ?> 
		  </div>
		</div>
	
	</div>
</div>

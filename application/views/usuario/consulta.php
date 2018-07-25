?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
	<div class="col-md-6 center-block no-float">	
		<div class="panel panel-success">
		  <div class="panel-heading" align="center">
		    <h3 class="panel-title" ><?php echo $panel_title; ?></h3>
		  </div>
		  <div class="panel-body" align="center">
		    <div class="imgcontainer">
		      	<img src="<?php echo base_url(); ?>assets/img/verumcard_logo_ltl.png" alt="Avatar" class="avatar">
		    </div>
		    <!--form action="<?php echo base_url(); ?> signin" method="post"-->
		    
		    <?php  if (validation_errors()) { echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>'; }  ?> 
		    <div id="message"></div>
		    <?php echo form_open('registro/registroInsertar'); ?> 
		  <div class="form-group" align="left">
		    <label for="nombres">Nombres</label>
		    <input type="text" name="nombres" value="<?php echo set_value('nombres'); ?>" class="form-control" id="uv_nombre_a" placeholder="Nombres" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="apellidos">Apellidos</label>
		    <input type="text" name="apellidos" value="<?php echo set_value('apellidos'); ?>" class="form-control" id="uv_apellido_a" placeholder="Apellidos" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="email">Correo Electronico</label>
		    <input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control" id="email" placeholder="Email" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="fenacimiento">Fecha de Nacimiento</label>
		    <!--input type="date" name="fenacimiento" value="<?php echo set_value('fenacimiento'); ?>" class="form-control" id="uv_fecha_nacimiento_d"-->
		    <input type="date" name="fenacimiento" step="1" min="1940-01-01" max="2000-12-31" value="1940-01-01" <?php echo set_value('fenacimiento'); ?>" class="form-control" id="uv_fecha_nacimiento_d">
		  </div>
		  <div class="form-group" align="left">
		    <label for="contrasena">Contraseña</label>
		    <input type="password" name="password" value="<?php echo set_value('contrasena'); ?>" class="form-control" id="uv_clave_a" placeholder="Contraseña" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="passconf">Confirmación Clave</label>
		    <input type="password" name="passconf" class="form-control" id="pass2" placeholder="Password">
		  </div>

		  <button type="submit" class="btn btn-success">Registrar</button>
			<?php echo form_close(); ?> 
		  </div>
		</div>
	
	</div>
</div>
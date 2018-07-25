<?php
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
		    <?php echo form_open($tp_signin); ?> 
		  <div class="form-group" align="left">
		    <label for="email">Correo Electronico</label>
		    <input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control" id="email" placeholder="Email" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="pass">Contraseña</label>
		    <input type="password" name="pass" class="form-control" id="pass" placeholder="Password">
		  </div>
		  <div class="form-group" align="center">
		    <a  href="#">Olvidó su contraseña?</a>
		    <!--input type="hidden" name="tpus"  id="tpus" value="<?php// echo $es_admin; ?>"-->
		  </div>
		  <div>
		   <button type="submit" class="btn btn-success">Entrar</button>
			<?php echo form_close(); ?> 
		  </div>
		</div>
	
	</div>
</div>


<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//.$datos(0)->tt_id_tarjeta_pk
//print_r($datossel);
//echo $datos[0]->tt_id_tarjeta_pk;$idusuario,$prefnac,$cedulatit,$nbtit,$email,$idbanco
$selnac = array('' =>'Seleccione Nacionalidad' ,'V' =>'Venezolano' ,'E'=>'Extrangero','J'=>'Juridico' );
if (isset($datos)) {
	$id = $datos[0]->rc_numero_cuenta_i_pk;
	$idusuario =$datos[0]->rc_us_verumcard_a_pk;
	$prefnac =$datos[0]->rc_prefijo_a;
	$email =$datos[0]->us_email_a;
	$cedulatit =$datos[0]->ct_ced_rif_a;
	$nbtit =$datos[0]->us_clave_a;
	$idbanco=$datos[0]->bc_id_banco_a_pk;
	$banco= (array)$datossel;
	//print_r($datossel1[0]);
	$target='cuentaenvio/editarcuentaenvio/'.$id;
	$boton = "Modificar Registro";

} else {
	$id=set_value('id');
	//$idusuario =set_value('nucuenta');
	$prefnac =set_value('idnac');
	$email =set_value('email');
	$cedulatit =set_value('cititular');
	$nbtit =set_value('nbtitular');
	$idbanco=set_value('idbanco');
	$datossel1=$datossel;
	$target='cuentaenvio/insertarcuentaenvio';
	$boton = "Insertar Registro";
}

/*$prefnac=$this->input->post('idnac');
        		$cedulatit=$this->input->post('cititular');
        		$nbtit=$this->input->post('nbtitular');
        		$emailtit=$this->input->post('email');
        		$idbanco=$this->input->post('idbanco');
	*/
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
		    <!--input type="hidden" name="id" value="<?php echo $id ?>" class="form-control" id="id" -->
		    <div class="form-group" align="left">
		    <label for="id">Numero de Cuenta</label>
		    <input type="text" name="id" value="<?php echo $id ?>" class="form-control" id="id" placeholder="Numero de Cuenta Bancaria" >
		  <div class="form-group" align="left">
		    <label for="txnombre">Nombre del Titular</label>
		    <input type="text" name="nbtitular" value="<?php echo $nbtit ?>" class="form-control" id="nbtitular" placeholder="Nombre del Titular" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="txcititular">Cedula del Titular</label>
		    <input type="text" name="cititular" value="<?php echo $cedulatit ?>" class="form-control" id="cititular" placeholder="Nombre del Titular" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="idnac">Nacionalidad</label>
		    <?php echo form_dropdown('idnac',$selnac,$prefnac); ?>
		  </div>
		  <div class="form-group" align="left">
		    <label for="txmail">Email</label>
		    <input type="text" name="email" value="<?php echo $email ?>" class="form-control" id="email" placeholder="Email formato aaaa@aa.com" >
		  </div>
		  <div class="form-group" align="left">
		    <label for="selbancos">Bancos</label>
		    <select name="idbanco" id="idbanco">
		    	<option value="0" >Seleccione Banco</option>
    	<?php  	foreach ($datossel as $row) { ?>
    			<option value="<?php echo $row->bc_id_banco_a_pk ?>" <?php echo ($row->bc_id_banco_a_pk==$idbanco) ? "selected=selected" : ""; ?>><?php echo $row->bc_entidad_bancaria_a; ?></option>
    	<?php
    		}
    	?>
		    </select>
		<?php 	//echo form_dropdown('rol2', $datossel1, $rol); ?>
		  </div>
		  <div class="form-group" align="center">
		    <button type="submit" class="btn btn-success"><?php echo $boton ?></button>
		  </div>
			<?php echo form_close(); ?> 
		  </div>
		</div>
	
	</div>
</div>

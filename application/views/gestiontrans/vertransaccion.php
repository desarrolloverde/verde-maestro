<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*operacion para el llenado de listado de analistas*/

$costatus=$transaccion[0]->tg_codigo_estatus_i;
$target="";
$id=$transaccion[0]->tg_numero_ref_n_pk;
if ($costatus==5) {
	$selnac = array('' =>'Seleccione tipo de id' ,'V' =>'Venezolano' ,'E'=>'Extrangero','J'=>'Juridico' );
	$idcta = $datoscuenta[0]->rc_id_cuenta_a_pk;
	$nucuenta = $datoscuenta[0]->rc_numero_cuenta_a;
	$prefnac =$datoscuenta[0]->rc_prefijo_a;
	$email =$datoscuenta[0]->rc_email_a;
	$cedulatit =$datoscuenta[0]->ct_ced_rif_a;
	$nbtit =$datoscuenta[0]->rc_nombre_titular_a;
	$target = "gestiontransaccion/correcciontransaccion/".$id;
}
?>
<div class="container">		
	<div class="col-md-12" >	
		<div class="panel panel-success">
			  <div class="panel-heading" align="center">
			    <h2 class="panel-title" ><?php echo $panel_title ?></h2>
			  </div>
			  <?php echo form_open($target) ?> 
			  <?php  if (validation_errors()) { echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>'; }  ?> 
		    <div id="message"></div>
			<div class="panel-body" align="center">			    
			  <!--div class="form-group" align="left"-->
			  <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control" id="id" >
			  	<div class="form-row" align="left">
	    			<div class="form-group col-md-12">
					    <label for="txtcta">Datos de Cuentas destino</label>
					    <p><?php echo $transaccion[0]->ctadestino ?></p>
					</div>
					<div class="form-group col-md-12">
					    <label for="txmdatos">Datos del Cliente</label>
					    <p><?php echo $transaccion[0]->usuario ?></p>
					</div>
			  	</div>
			  <div class="form-row" align="left">
					<div class="form-group col-md-6" align="left">
					    <label for="montofee">Monto de Fee (Calculo al <?php echo $porcfee; ?>%)</label>
					    <p><?php echo $transaccion[0]->tg_monto_fee_us_n ?></p>
					</div>
				    <div class="form-group col-md-6" align="left">
				    	<label for="montotot">Monto Total</label>  
				    	<p><?php echo $transaccion[0]->tg_monto_total_bs_n ?></p>
				  </div>
			  </div>
			  <?php if ($costatus==4 || $costatus==5) { ?>
			  	<div class="form-row" align="left">
					<div class="form-group col-md-6" align="left">
					    <label for="txtatencion">Informacion de Atencion</label>
					  	<?php if ($costatus==4) {?><p><?php echo "Atendido en .... Minutos"; } elseif ($costatus==5) { echo "Cancelado en .... Horas";	} ?></p>
					    <!--p><?php echo "Caso atendido por".$transaccion[0]->asignado  ?></p-->
					</div> 
					<div class="form-group col-md-6" align="center">
					<?php if ($costatus==5) {?>
					<div class="form-group col-md-6" align="center">
						<label for="txtacciones">Operacion cancelada Por favor corregir</label> 
					</div>
					</div>
					<div class="form-group col-md-12" align="center">
						    <label for="txtarchivo">Para corregir cuenta hacer click aqui</label>
						 <!-- Button trigger modal -->
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cuentaModalCenter">
						  Corregir Cuenta
						</button>
					</div>
						<?php } elseif ($costatus==4) { ?>
							<p><?php echo "Transferencia realizada al banco";?></p>
							<p><?php echo "Nro de Transferencia";?></p>
					</div>
						<div class="form-group col-md-12" align="center">
						    <label for="txtarchivo">Descargar Archivo de verificacion Aqui</label>
						    <a href="<?php echo base_url('index.php/gestiontransaccion/downloads/'.$dataasignacion[0]->fpath) ?>" title='Documento de Transferencia'><br><img src="<?php echo base_url().'assets/img/descargar.png' ?>"></a>
						</div>

				    	<?php } ?>
			  	</div>
			  	

					  <?php } //finde la condicion de transaccion pendiente?> 
				</div>
				<!-- Modal -->
				<?php if ($costatus==5) {?>
				<div class="modal fade" id="cuentaModalCenter" tabindex="-1" role="dialog" aria-labelledby="cuentaModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header" align="center">
				        <h3 class="modal-title" id="cuentaModalLongTitle">Datos de Cuenta Bancaria de Envio</h3>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      	<input type="hidden" name="idcta" value="<?php echo $idcta ?>" class="form-control" id="idcta" >
				        <div class="form-group" align="left">
						    <label for="id">Numero de Cuenta</label>
						    <input type="text" name="nucuenta" value="<?php echo $nucuenta ?>" class="form-control" id="nucuenta" placeholder="Numero de Cuenta Bancaria" >
						</div>
						  <div class="form-group" align="left">
						    <label for="txnombre">Nombre del Titular</label>
						    <input type="text" name="nbtitular" value="<?php echo $nbtit ?>" class="form-control" id="nbtitular" placeholder="Nombre del Titular" >
						  </div>
						  <div class="form-group" align="left">
						    <label for="txcititular">Cedula o Rif Titular</label>
						    <?php echo form_dropdown('idnac',$selnac,$prefnac,'class="form-control col-md-6"'); ?>
						    <input type="text" name="cititular" value="<?php echo $cedulatit ?>"  class="form-control col-md-6" id="cititular" placeholder="Nombre del Titular" >
						  </div>
						  <div class="form-group" align="left">
						    <label for="txmail">Email</label>
						    <input type="text" name="email" value="<?php echo $email ?>" class="form-control" id="email" placeholder="Email formato aaaa@aa.com" >
						  </div>						
				      </div>
				      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					        <button type="submit" class="btn btn-primary">Salvar Cambios</button>
				      </div>
				    </div>
				  </div>
				</div>
				<?php } ?>

				<?php echo form_close(); ?> 			  
			</div>
		
		</div>
	</div>
</div>

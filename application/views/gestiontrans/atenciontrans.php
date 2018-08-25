<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*operacion para el llenado de listado de analistas*/
$analistas[""]="Seleccione Analista";
foreach ($selanalistas as $registros) {
	$analistas[$registros->us_id_usuario_a_pk]="Analista ".$registros->us_nombre_a." ".$registros->us_apellido_a;
}
/*Si el analista fue asignado validar y tomar*/
$idanalista=(isset($dataasignacion[0]->idusuario)) ? $dataasignacion[0]->idusuario : "";

?>
<div class="container">		
	<div class="col-md-12" >	
		<div class="panel panel-success">
			  <div class="panel-heading" align="center">
			    <h2 class="panel-title" ><?php echo $panel_title ?></h2>
			  </div>
			  <?php echo form_open_multipart($target) ?> 
			<div class="panel-body" align="center">
			    <?php  if (validation_errors()) { echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>'; }  ?> 
			    <input type="hidden" name="id" name="id" value="<?php echo $id ?>" >
			    
			  <!--div class="form-group" align="left"-->
			  	<div class="form-row" align="left">
	    			<div class="form-group col-md-12">
					    <label for="txtcta">Datos de Cuentas destino</label>
					    <p><?php echo $datostrans[0]->ctadestino ?></p>
					</div>
					<div class="form-group col-md-12">
					    <label for="txmdatos">Datos del Cliente</label>
					    <p><?php echo $datostrans[0]->usuario ?></p>
					</div>
			  	</div>
			  <div class="form-row" align="left">
					<div class="form-group col-md-6" align="left">
					    <label for="montofee">Monto de Fee (Calculo al <?php echo $porcfee; ?>%)</label>
					    <p><?php echo $datostrans[0]->tg_monto_fee_us_n ?></p>
					</div>
				    <div class="form-group col-md-6" align="left">
				    	<label for="montotot">Monto Total</label>  
				    	<p><?php echo $datostrans[0]->tg_monto_total_bs_n ?></p>
				  </div>
			  </div>
			  <?php if ($costatus==4 || $costatus==5) { ?>
			  	<div class="form-row" align="left">
					<div class="form-group col-md-6" align="left">
					    <label for="msjasig">Informacion de Atencion</label>
					  	<?php if ($costatus==4) {?><p><?php echo "Atendido en .... Minutos"; } elseif ($costatus==5) { echo "Cancelado en .... Horas";	} ?></p>
					    <p><?php echo "Caso atendido por".$dataasignacion[0]->analista  ?></p>					  
					</div>
				    <div class="form-group col-md-6" align="left">
						<label for="montotot">Información del Caso</label>  
						<?php if ($costatus==5) {?>
							<p><?php echo "Cancelado en .... Minutos"; ?></p>

					</div>

						<?php } elseif ($costatus==4) { ?>
							<p><?php echo "Transferencia realizada al banco";?></p>
							<p><?php echo "Nro de Transferencia";?></p>
					</div>
						<div class="form-group col-md-12" align="center">
						    <label for="txtarchivo">Descargar Archivo de verificacion Aqui</label>
						    <a href="<?php echo base_url('index.php/gestiontransaccion/downloads/'.$dataasignacion[0]->fpath) ?>" title='Documento de Transferencia'><img src="<?php echo base_url().'assets/img/descargar.png' ?>"></a>
						</div>

				    	<?php } ?>
			  	</div>
			  	


			  <?php } else { ?>
				<div class="form-group col-md-12" align="left">
					  <div class="panel-group" id="accordion">
					  	<?php if ($idrol==1) { ?>
					    <div class="panel panel-primary">
					      <div class="panel-heading">
					        <h4 class="panel-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Asignar analista Aqui</a>
					        </h4>
					      </div>
					      <div id="collapse1" class="panel-collapse collapse">
					        <div class="panel-body">
					        		<div class="form-group" align="center">
					        			<label for="txnutrans">Elija analista para procesar transaccion</label>
									  	<?php echo form_dropdown("idanalista",$analistas,$idanalista,"class='form-control'");?>
									    <input  type="submit" name="submit"  class="btn btn-primary" value=<?php echo ($idanalista=="") ? "Asignar" : "Reasignar"  ?>>
									</div>
					        </div>
					      </div>
					    </div>
					<?php } //fin de opcion para supervisores o administradores
					?>
					    <div class="panel panel-success">
					      <div class="panel-heading">
					        <h4 class="panel-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Ejecutar Transferencia Aqui</a>
					        </h4>
					      </div>
					      <div id="collapse2" class="panel-collapse collapse">
					        <div class="panel-body">
					        	<div class="form-group" align="left">
								    <label for="imagen">Anexar Archivo de Transferencia</label>
								    <input type="file" name="archivo"  class="form-control-file" id="archivo" placeholder="Seleccione archivo de verificacion de transferencia" >
								</div>
						        <div class="form-group" align="center">
							  		<label for="txnutrans">Ingrese Datos de transaccion</label>
			    						<input type="text" name="nutransferencia"  class="form-control" id="nutrans" placeholder="Numero de transferencia" >
							    	<input  type="submit" name="submit"  class="btn btn-success" value="Ejecutar">
								</div>
							</div>
					      </div>
					    </div>
					    <div class="panel panel-danger">
					      <div class="panel-heading">
					        <h4 class="panel-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Para cancelar transaccion Aqui</a>
					        </h4>
					      </div>
					      <div id="collapse3" class="panel-collapse collapse">
					        <div class="panel-body">
						        <div class="form-group" align="center">
							  		<label for="txnutrans">Explique porque cancela transaccion</label>		    						
			    						<input type="text" name="txcancelar"  class="form-control" id="txcancelar" placeholder="Explicacion de cancelacion" >
							    	<input  type="submit" name="submit"  class="btn btn-danger" value="Cancelar">
								</div>
					       </div>
					   		</div>
					      </div>
					    </div>
					  </div>
					  <?php } //finde la condicion de transaccion pendiente?> 
				</div>
				<?php echo form_close(); ?> 
			  
			</div>
		
		</div>
	</div>
</div>

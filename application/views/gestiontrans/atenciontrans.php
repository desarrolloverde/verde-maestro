<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*operacion para el llenado de listado de analistas*/
$analistas[""]="Seleccione Analista";
foreach ($selanalistas as $registros) {
	$analistas[$registros->us_id_usuario_a_pk]="Analista ".$registros->us_nombre_a." ".$registros->us_apellido_a;
}
?>
<div class="container">		
	<div class="col-md-12" >	
		<div class="panel panel-success">
			  <div class="panel-heading" align="center">
			    <h2 class="panel-title" ><?php echo $panel_title ?></h2>
			  </div>
			  <?php echo form_open($target) ?> 
			<div class="panel-body" align="center">
			    <?php  if (validation_errors()) { echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>'; }  ?> 
			    <input type="hidden" name="id" value="<?php echo $id ?>" >
			    
			  <!--div class="form-group" align="left"-->
			  	<div class="form-row" align="left">
	    			<div class="form-group col-md-12">
					    <label for="Gift_card">Datos de Cuentas destino</label>
					    <p><?php echo $datostrans[0]->ctadestino ?></p>
					</div>
					<div class="form-group col-md-12">
					    <label for="txmontotasa">Datos del Cliente</label>
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
			  
				<div class="form-group col-md-12" align="left">
					  <div class="panel-group" id="accordion">
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
									  	<?php echo form_dropdown("idanalista",$analistas,'class="form-control"');?>
									    <input  type="submit" name="submit"  class="btn btn-primary" value="Asignar">
									</div>
					        </div>
					      </div>
					    </div>
					    <div class="panel panel-success">
					      <div class="panel-heading">
					        <h4 class="panel-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Ejecutar Transferencia Aqui</a>
					        </h4>
					      </div>
					      <div id="collapse2" class="panel-collapse collapse">
					        <div class="panel-body">
						        <div class="form-group" align="center">
							  		<label for="txnutrans">Ingrese Datos de transaccion</label>
			    						<input type="text" name="nutrans"  class="form-control" id="nutrans" placeholder="Numero de transferencia" >
			    						<input type="text" name="txtrans"  class="form-control" id="txtrans" placeholder="Detalle u Observaciones" >
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
			    						<input type="text" name="txtransfalla"  class="form-control" id="txtransfalla" placeholder="Exlpicacion de cancelacion" >
							    	<input  type="submit" name="submit"  class="btn btn-danger" value="Cancelar">
								</div>
					       </div>
					   		</div>
					      </div>
					    </div>
					  </div> 
				</div>
				<?php echo form_close(); ?> 
			  
			</div>
		
		</div>
	</div>
</div>

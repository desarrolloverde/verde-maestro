<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*

*/
$tasa='';
//$idmon =  array('Seleccione Moneda' => '' );
foreach ($datossel as $row) {
	$idmon[$row->mn_id_moneda_a_pk]=$row->mn_prefijo_a;
}
?>

<div class="container">
	<div class="col-md-6 center-block no-float">
		<div class="panel panel-success">
			<div id="panel-body">
				<div class="panel panel-success">
				  <div class="panel-heading" align="center">
				    <h3 class="panel-title" ><?php echo $panel_title; ?></h3>
				    <h4 class="panel-title" >Registro de Tasas</h4>
				  </div>
				  <div class="panel-body" align="center">
				    <?php  if (validation_errors()) { echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>'; }  ?> 
				    <div id="message"></div>
				    <?php echo form_open($target, 'name="miform"') ?> 
				    <input type="hidden" name="moneda"  id="moneda" >
				  <div class="form-group" align="left">
				    <label for="tasa">Valor de la Tasa</label>
				    <input type="text" name="tasa" value="<?php echo set_value($tasa); ?>" class="form-control" id="tasa" placeholder="tasa" >
				  </div>
				  <div class="form-group" align="left">
		    		<label for="Moneda">Tipo Moneda</label>
		    			<?php echo form_dropdown('fidmoneda',$idmon,$moneda,'class="form-control" onchange="javascript: document.getElementById(\'moneda\').value=this.value; document.miform.action=\'tasa\'; document.miform.submit()" '); ?>
		  		</div>
				  <button type="submit" class="btn btn-success"><?php echo $boton ?></button>
					<?php echo form_close(); ?> 
				  </div>
				</div>
				<div class="panel-heading" align="center">
				<h3 align="center"><?php echo $panel_title1; ?></h3>
				<h4 align="center">Ultimos 10 registros de Tasas</h4>
			</div>
				<table class="table table-bordered">
						<thead>
						<tr>
  							<th>#</th><th>Moneda</th><th>valor</th><th>Estatus</th><th>Fecha registro</th>
  						</tr>
  						</thead>
  						<tbody>
						<?php
						$i=0;
						if (count($datos)>0) {
						foreach ($datos as $row) { ?>
							<tr <?php echo ($row->ts_estatus_b=='f') ? 'class="danger"':'class="active"'; ?> >
										<td><?php echo ++$i; ?></td>
										<td><?php echo $row->moneda; ?></td>
										<td><?php echo $row->ts_valor_n." BsF"; ?></td>
										<td><?php echo ($row->ts_estatus_b=='t') ? "ACTIVO":"INACTIVO";?></td>
										<td><?php echo $row->ts_fe_registro_t; ?></td>
								</tr>
						<?php }	} else { 					?>
								<tr><td colspan="5" align="center">No existen datos cargados o debe seleccionar moneda</td></tr>
						<?php } 					?>  						
  						</tbody>
				</table>				
			</div>
		</div>	
	</div>
</div>

</body>
</html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*operacion para el llenado de los tabs*/
foreach ($titletabs as $datostab) {
	$estatus=($sttrans==$datostab->id) ?  $datostab->status :  '';
}
?>

<div class="container">
	<div class="col-md-8 center-block no-float">
		<ul class="nav nav-tabs">
			<?php foreach ($titletabs as $datostab) {  ?>
		    <li <?php echo ($sttrans==$datostab->id) ?  'class="active tab-success"' :  '' ?>>
		    	<a href="<?php echo base_url('index.php/gestiontransaccion/listadoDisplay/'.$datostab->id); ?>"><?php echo $datostab->status.": ".$datostab->total; ?></a>
		    </li>
		<?php  } ?>
	  	</ul>	
		<div id="panel-body">
		<table class="table table-bordered">
					<thead>
					<tr>
							<th>#</th><th>Cuenta Destino</th><th>Monto Total</th><th>Tasa</th><th>Estatus</th><th>Fecha de registro</th><th>Acciones</th>
						</tr>
						</thead>
						<tbody>
					<?php
					if ($datos) {
						foreach ($datos as $row) { 
							$atendido= ($row->asignado!="") ? " Atendido por: ".$row->asignado : " Sin asignacion";
							?>
							<tr>
										<td><?php echo ++$start_index; ?></td>
										<td><?php echo $row->ctadestino; ?></td>
										<td><?php echo $row->tg_monto_total_bs_n; ?></td>
										<td><?php echo $row->tg_monto_tasa_us_n; ?></td>
										<td><?php echo $row->status.$atendido ?></td>
										<td><?php echo $row->tg_fe_registro_t; ?></td>
										<td><a href="<?php echo base_url('index.php/gestiontransaccion/atenciontransaccion/'.$row->tg_numero_ref_n_pk); ?>" title='ver'><span class='glyphicon glyphicon-eye-open'></span></a><!--href='gestiontransaccion/gestiontransaccion/<?php echo $row->tg_numero_ref_n_pk; ?>'-->
											
										</td>
								</tr>
						<?php }	
						} else {	?>
						<tr>
							<td colspan="7" align="center">No hay Transacciones en estatus <?php echo $estatus ?></td>
							</tr>
						<?php } ?>
					<tr>
							<td colspan="7" align="center">
								<?php if (isset($params['links'])) { ?>
			                <?php echo $params['links'] ?>
			            	<?php } ?>
							</td>
						</tr>  						
						</tbody>
			</table>				
		</div>
	</div>		
</div>	

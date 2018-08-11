<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
/***SELECT fe_id_fee_n_pk, fe_porcentaje_fee_n, fe_estatus_b, fe_id_sesion_a, 
       fe_fe_registro_t, fe_descripcion_fee
  FROM verumbd.vc_m_fee;
*/

?>

<div class="container">
	<div class="col-md-6 center-block no-float">
		<div class="panel panel-success">
			<div class="panel-heading" align="center">
				<h3 align="center"><?php echo $panel_title; ?></h3>
			</div>
			<div id="panel-body">
			<table class="table table-bordered">
						<thead>
						<tr>
  							<th>#</th><th>Porcentaje</th><th>Descripcion</th><th>Estatus</th><th>Acciones</th>
  						</tr>
  						</thead>
  						<tbody>
						<?php
						$i=0;
						if (count($datos)>0) {
							foreach ($datos as $row) { ?>								
								<tr <?php echo ($row->fe_estatus_b=='f') ? 'class="danger"':'class="active"'; ?>>
											<td><?php echo ++$i ?></td>
											<td><?php echo $row->fe_porcentaje_fee_n; ?></td>
											<td><?php echo $row->fe_descripcion_fee; ?></td>
											<td><?php echo ($row->fe_estatus_b=='t') ? "ACTIVO":"INACTIVO"; ?></td>
											<td><a href='fee/editarDisplay/<?php echo $row->fe_id_fee_n_pk; ?>' title='Editar'><span class='glyphicon glyphicon-pencil'></span></a>
												<a href='fee/borrarFee/<?php echo $row->fe_id_fee_n_pk; ?>' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></a>
											</td>
									</tr>
							<?php }						?>
						<?php }	else {		?>
							<tr><td colspan="5" align="center">No se han cargado registros</td></tr>
						<?php } ?>

						<tr>
  							<td colspan="5" align="center">
  								<button type="button" class="btn btn-default navbar-btn" onclick = "location='<?php echo base_url(); ?>index.php/fee/registroDisplay'">Nuevo registro</button>

  							</td>
  						</tr>  						
  						</tbody>
				</table>				
			</div>
		</div>	
	</div>	
</div>

</body>
</html>
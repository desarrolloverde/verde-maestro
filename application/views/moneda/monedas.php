<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
/***SELECT mn_id_moneda_a_pk, mn_prefijo_a, mn_descripcion_a, mn_estatus_b, 
       mn_id_sesion_a, mn_fe_registro_t
  FROM verumbd.vc_m_moneda;
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
  							<th>#</th><th>Prefijo</th><th>Descripcion</th><th>Estatus</th><th>Acciones</th>
  						</tr>
  						</thead>
  						<tbody>
						<?php
						$i=0;
						if (count($datos)>0) {
							foreach ($datos as $row) { ?>
								<tr <?php echo ($row->mn_estatus_b=='f') ? 'class="danger"':'class="active"'; ?>>
											<td><?php echo ++$i ?></td>
											<td><?php echo $row->mn_prefijo_a; ?></td>
											<td><?php echo $row->mn_descripcion_a; ?></td>
											<td><?php echo ($row->mn_estatus_b=='t') ? "ACTIVO":"INACTIVO"; ?></td>
											<td><a href='moneda/editarDisplay/<?php echo $row->mn_id_moneda_a_pk; ?>' title='Editar'><span class='glyphicon glyphicon-pencil'></span></a>
												<a href='moneda/borrarMoneda/<?php echo $row->mn_id_moneda_a_pk; ?>' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></a>
											</td>
									</tr>
							<?php }						?>
						<?php }	else {		?>
							<tr><td colspan="5" align="center">No se han cargado registros</td></tr>
						<?php } ?>

						<tr>
  							<td colspan="5" align="center">
  								<button type="button" class="btn btn-default navbar-btn" onclick = "location='<?php echo base_url(); ?>index.php/moneda/registroDisplay'">Nuevo registro</button>

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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
private  $clstabla='vc_m_us_administrativos';
        private  $tbl_idpk='us_id_usuario_a_pk';
        private  $tbl_clave='us_clave_a';
        private  $tbl_nombre='us_nombre_a';
        private  $tbl_rol='us_id_a_pk';
        private  $tbl_apellido='us_apellido_a';
        private  $tbl_email='us_email_a';
        private  $tbl_estatus='us_estatus_b';
        private  $tbl_feregistro='us_fe_registro_t';
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
  							<th>#</th><th>Nombres</th><th>Apellidos</th><th>rol</th><th>Email</th><th>Acciones</th>
  						</tr>
  						</thead>
  						<tbody>
						<?php
						foreach ($datos as $row) { ?>
							<tr>
										<td><?php echo $row->us_id_usuario_a_pk; ?></td>
										<td><?php echo $row->us_nombre_a; ?></td>
										<td><?php echo $row->us_apellido_a; ?></td>
										<td><?php echo $row->rol; ?></td>
										<td><?php echo $row->us_email_a; ?></td>
										<td><a href='cuentaenvio/editarDisplay/<?php echo $row->us_id_usuario_a_pk; ?>' title='Editar'><span class='glyphicon glyphicon-pencil'></span></a>
											<a href='cuentaenvio/borrarcuentaenvio/<?php echo $row->us_id_usuario_a_pk; ?>' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></a>
										</td>
								</tr>
						<?php }						?>
						<tr>
  							<td colspan="6" align="center">
  								<button type="button" class="btn btn-default navbar-btn" onclick = "location='<?php echo base_url(); ?>index.php/cuentaenvio/registroDisplay'">Nuevo registro</button>

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
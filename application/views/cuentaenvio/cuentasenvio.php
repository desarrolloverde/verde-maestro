<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*

*/
?>

<div class="container">
	<div class="col-md-8 center-block no-float">
		<div class="panel panel-success">
			<div class="panel-heading" align="center">
				<h3 align="center"><?php echo $panel_title; ?></h3>
			</div>
			<div id="panel-body">
			<table class="table table-bordered">
						<thead>
						<tr>
  							<th>#</th><th>Nombre de Titular</th><th>Identificacion</th><th>Cuenta Bancaria</th><th>Banco</th><th>Acciones</th>
  						</tr>
  						</thead>
  						<tbody>
						<?php
						$i=0;
						foreach ($datos as $row) { ?>
							<tr>
										<td><?php echo ++$i; ?></td>
										<td><?php echo $row->rc_nombre_titular_a; ?></td>
										<td><?php echo $row->rc_prefijo_a."-".$row->ct_ced_rif_a; ?></td>
										<td><?php echo $row->rc_numero_cuenta_a; ?></td>
										<td><?php echo $row->banco; ?></td>
										<td><a href='cuentaenvio/editarDisplay/<?php echo $row->rc_id_cuenta_a_pk; ?>' title='Editar'><span class='glyphicon glyphicon-pencil'></span></a>
											<a href='cuentaenvio/borrarcuentaenvio/<?php echo $row->rc_id_cuenta_a_pk; ?>' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></a>
										</td>
								</tr>
						<?php }	 ?>
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
private  $clstabla='vc_m_bancos';
        private  $tbl_idpk='bc_id_banco_a_pk';
        private  $tbl_entidad='bc_entidad_bancaria_a';
        private  $tbl_estatus='bc_estatus_b';
        private  $tbl_sesion='bc_id_sesion_a';
        private  $tbl_feregistro='bc_fe_registro_t';
        private  $tbl_coentidad='bc_co_entidad_a';
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
  							<th>#</th><th>Entidad Bancaria</th><th>Codigo de Entidad</th><th>Acciones</th>
  						</tr>
  						</thead>
  						<tbody>
						<?php 
						$i=0;
						foreach ($bancos as $row) {
							echo "<tr>
										<td>".++$i."</td>
										<td>$row->bc_entidad_bancaria_a</td>
										<td>$row->bc_co_entidad_a</td>
										<td><a href='banco/editarDisplay/$row->bc_id_banco_a_pk' title='Editar'><span class='glyphicon glyphicon-pencil'></span></a>
											<a href='banco/borrarBanco/$row->bc_id_banco_a_pk' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></a>
										</td>
								</tr>";
						}
						?>
						<tr>
  							<td colspan="4" align="center">
  								<button type="button" class="btn btn-default navbar-btn" onclick = "location='<?php echo base_url(); ?>index.php/banco/registroDisplay'">Nuevo registro</button>

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
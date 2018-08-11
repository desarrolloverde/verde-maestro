<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
private  $clstabla='vc_m_bancos';
 tt_id_tarjeta_pk character varying(6) NOT NULL DEFAULT nextval('seq_vc_m_franquicia_tt_id_tarjeta_pk'::regclass),
  tt_descripcion_a character varying(20) NOT NULL, -- SI ES VISA, MASTERCARD, ELECTRON, MAESTRO
  tt_estatus_b boolean NOT NULL DEFAULT true, -- Estatus del rol
  tt_id_sesion_a character(11) NOT NULL, -- Valor ID de la sesion
  tt_fe_registro_t timestamp without time zone NOT NULL, -- Fecha de resgistro
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
  							<th>#</th><th>Valor de GiftCard</th><th>Imagen</th><th>Acciones</th>
  						</tr>
  						</thead>
  						<tbody>
						<?php
						$i=0;
						foreach ($datos as $row) { ?>
							<tr>
										<td><?php echo ++$i ?></td>
										<td><?php echo $row->gf_valor_i; ?></td>
										<td><?php if ($row->ruta=="") { echo "Falta cargar Imagen"; } else { echo "<img src='".base_url()."$row->ruta'  width='50%' class='img-thumbnail' >"; }?></td>
										<td><a href='giftcardadm/editarDisplay/<?php echo $row->gf_id_gifcard_i_pk; ?>' title='Editar'><span class='glyphicon glyphicon-pencil'></span></a>
											<a href='giftcardadm/borrarGiftcardadm/<?php echo $row->gf_id_gifcard_i_pk; ?>' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></a>
										</td>
								</tr>
						<?php }						?>
						<tr>
  							<td colspan="4" align="center">
  								<button type="button" class="btn btn-default navbar-btn" onclick = "location='<?php echo base_url(); ?>index.php/giftcardadm/registroDisplay'">Nuevo registro</button>

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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
private  $clstabla='vc_m_transaccion_giftcard';
        private  $tbl_idpk='tg_numero_ref_n_pk';
        private  $tbl_porcfee='tg_porcentaje_fee_n';
        private  $tbl_nutarjeta='tg_numero_tarjeta_a';
        private  $tbl_montofee='tg_monto_fee_us_n';
        private  $tbl_montodisp='tg_monto_disp_us_n';
        private  $tbl_promoreal='tg_promo_real_us_n';
        private  $tbl_montotot='tg_monto_total_bs_n';
        private  $tbl_codstatus='tg_codigo_estatus_i';
        private  $tbl_idsesion='tg_id_sesion_a';
        private  $tbl_cuentaenv='tg_cuenta_envio_a';
        private  $tbl_idtarjeta='tg_id_tarjeta_i_fk';
        private  $tbl_montotasa='tg_monto_tasa_us_n';
        private  $tbl_idtasa='tg_id_tasa_a_fk';
        private  $tbl_feregistro='tg_fe_registro_t';

*/
?>

<div class="container">
	<div class="col-md-10 center-block no-float">
		<div class="panel panel-success">
			<div class="panel-heading" align="center">
				<h3 align="center"><?php echo $panel_title; ?></h3>
			</div>
			<div id="panel-body">
			<table class="table table-bordered">
						<thead>
						<tr>
  							<th>#</th><th>Cuenta Destino</th><th>Monto Total</th><th>Tasa</th><th>Estatus</th><th>Fecha de registro</th><th>Acciones</th>
  						</tr>
  						</thead>
  						<tbody>
						<?php
						$i=0;
						foreach ($datos as $row) { ?>
							<tr>
										<td><?php echo ++$i; ?></td>
										<td><?php echo $row->ctadestino; ?></td>
										<td><?php echo $row->tg_monto_total_bs_n; ?></td>
										<td><?php echo $row->tg_monto_tasa_us_n; ?></td>
										<td><?php echo $row->status; ?></td>
										<td><?php echo $row->tg_fe_registro_t; ?></td>
										<td><a href='' title='ver'><span class='glyphicon glyphicon-eye-open'></span></a><!--href='transacciongc/consultarDisplay/<?php echo $row->tg_numero_ref_n_pk; ?>'-->
											
										</td>
								</tr>
						<?php }						?>
						<tr>
  							<td colspan="7" align="center">
  								<button type="button" class="btn btn-success navbar-btn" onclick = "location='<?php echo base_url(); ?>index.php/transacciongift/registroDisplay'">Nuevo registro</button>

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
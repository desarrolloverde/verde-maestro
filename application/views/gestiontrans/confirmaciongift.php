<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//.$datos(0)->tt_id_tarjeta_pk

//echo $datos[0]->tt_id_tarjeta_pk;
	//$target='transacciongift/registroDisplay';
	$boton = "Guardar Transaccion";
	$selfranquicia['']='Seleccione Cuenta';
	foreach ($listfranquicia as $rows) {
		$selfranquicia[$rows->tt_id_tarjeta_pk]=$rows->tt_descripcion_a; 
	}
if (isset($datos)) {
	$id=$datos(0)->tt_id_tarjeta_pk;
	$montogc =$datos(0)->tt_id_tarjeta_pk;
	$montotasa =$datos(0)->tt_id_tarjeta_pk;
	$montofee =$datos(0)->tt_id_tarjeta_pk;
	$montoprom =$datos(0)->tt_id_tarjeta_pk;
	$montotot =$datos(0)->tt_id_tarjeta_pk;
	$ctaenvio =$datos(0)->tt_id_tarjeta_pk;
	//$datosgc=$datosgc;
} else {
	$id = (!isset($id)) ? set_value('id') : $id ;
	$nutarjeta = (!isset($nutarjeta)) ? set_value('nutarjeta') : $nutarjeta;
	$tpfranquicia = (!isset($tpfranquicia)) ? set_value('tpfranquicia') : $tpfranquicia;
	$nombretarjeta = (!isset($nombretarjeta)) ? set_value('nombretarjeta') : $nombretarjeta;
	$vencimiento = (!isset($vencimiento)) ? set_value('vencimiento') : $vencimiento;
	$montogc = (!isset($montogc)) ? set_value('montogc') : $montogc;
	$montotot = (!isset($montotot)) ? set_value('montotot') : $montotot;
	$cvv = (!isset($cvv)) ? set_value('cvv') : $cvv;
	$ctaenvio = (!isset($ctaenvio)) ? set_value('ctaenvio') : $ctaenvio;
	$direccion = (!isset($direccion)) ? set_value('direccion') : $direccion;
	$gcselect = (!isset($gcselect)) ? NULL : $gcselect;	
	$idgc = (!isset($idgc)) ? set_value('idgc') : $idgc;
	//$datosgc=$datosgc;	
}
?>
<div class="container">
	<div class="row align-items-start">
		<div class="col-6 col-md-6">
			<div class="panel panel-success">
				<div class="panel-heading" align="center">
			    	<h2 class="panel-title" ><?php echo $panel_title; ?></h2>
				</div>
			
			<div class="panel-body" align="center">	
			<table class="table">
				<caption>Datos de la transaccion</caption>
				<thead>
					<tr align="center">
						<th colspan="4">Datos de Cuenta destino</th>
					</tr>
				</thead>
				<tbody>

					<tr>
						<td>Banco</td><td><?php echo $datoscuenta[0]->banco; ?></td><td>Cuenta Bancaria</td><td><?php echo $datoscuenta[0]->rc_numero_cuenta_a; ?></td>
					</tr>
					<tr>
						<td>Titular de Cuenta</td><td><?php echo $datoscuenta[0]->rc_nombre_titular_a; ?></td><td>Identificacion</td><td><?php echo $datoscuenta[0]->rc_prefijo_a."-".$datoscuenta[0]->ct_ced_rif_a; ?></td>
					</tr>
					<tr>
						<td>Cantidad GiftCard</td><td><?php echo $datosgc[0]->gf_valor_i."$"; ?></td></td><td>Monto Total</td><td><?php echo $montotot." Bs"; ?>
					</tr>
				</tbody>
			</table>
			 </div>
			</div>

		</div>
		<div class="col-6 col-md-6">	
			<div class="panel panel-success">
			  <div class="panel-heading" align="center">
			    <h2 class="panel-title" ><?php echo $panel_title1 ?></h2>
			  </div>

			  <div class="panel-body" align="center">
			    <?php  if (validation_errors()) { echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>'; }  ?> 
			    <div id="message"></div>
			    <?php echo form_open($target, 'name="miform"') ?> 
			    <input type="hidden" name="montogc" value="<?php echo $montogc ?>" class="form-control" id="montogc">
				<input type="hidden" name="montotot" value="<?php echo $montotot ?>" class="form-control" id="montotot">
				<input type="hidden" name="id" value="<?php echo $id ?>" class="form-control" id="id" >
			    <input type="hidden" name="idgc" value="<?php echo $idgc ?>" class="form-control" id="idgc" >
			    <input type="hidden" name="ctaenvio" value="<?php echo $ctaenvio ?>" class="form-control" id="ctaenvio" >
			  <div class="form-group" align="left">
			  		<div class="form-group col-md-5">
					    <label for="txtptarjeta">Tipo Tarjeta</label>
					    <?php echo form_dropdown('tpfranquicia',$selfranquicia,$tpfranquicia,'class="form-control"'); ?>
					</div>
	    			<div class="form-group col-md-7">
					    <label for="Tarjeta_pago">Numero de Tarjeta</label>
					    <input type="text" name="nutarjeta" value="<?php echo $nutarjeta ?>" class="form-control" id="nutarjeta" placeholder="Numero de 18 dig - tarjeta" >
					</div>

			  	</div>
			  <div class="form-row" align="left">
			  		<div class="form-group col-md-12">
					    <label for="txnomtarjeta">Nombre titular</label>
					    <input type="text" name="nombretarjeta" value="<?php echo $nombretarjeta ?>" class="form-control" id="nombretarjeta" placeholder="Nombre titular en tarjeta" >
					</div>
				  <div class="form-group col-md-6" align="left">
				    <label for="txvenc">Fecha de vencimiento</label>
				    <input type="date" step="1" min="2018-01-01" max="2025-12-31"  name="vencimiento" value="<?php echo $vencimiento ?>" class="form-control" id="vencimiento" placeholder="Seleccione Tarjeta para calculo..." >
					</div>

				    <div class="form-group col-md-6" align="left">
				    	<label for="cvv">CVV</label>
			    		<input type="text" name="cvv" value="<?php echo $cvv ?>" class="form-control" id="cvv" placeholder="Numero detras de la Tarjeta..." >  
				     
				  </div>
				  <div class="form-group col-md-12" align="left">
						<label for="txdirecc">Direccion:</label>
						<textarea name="direccion" id="direccion" placeholder="Direccion de domicilio" value="<?php echo $direccion ?>" class="form-control" cols="40" rows="2"></textarea>
						<!--input type="text" name="direccion" id="direccion" placeholder="Direccion de domicilio" value="" class="form-control" cols="40" rows="5"-->
				   </div>
			  </div>
			  
			<input  type="submit" name="registrocp"  class="btn btn-success" value="<?php echo $boton ?>"></button>
			  <!--button type="submit" name="bregistrogc"  class="btn btn-success"><?php echo $boton ?></button-->
			
				<?php echo form_close(); ?> 
			  </div>
			</div>
		
		</div>
	</div>
</div>

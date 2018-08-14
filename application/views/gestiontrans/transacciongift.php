<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//.$datos(0)->tt_id_tarjeta_pk

//echo $datos[0]->tt_id_tarjeta_pk;
	//$target='transacciongift/registroDisplay';
	$boton = "Confirmar Transaccion";
	$selctas['']='Seleccione Cuenta';
	foreach ($listctas as $rows) {
		$selctas[$rows->rc_id_cuenta_a_pk]="Cuenta del ".$rows->banco." # ".$rows->rc_numero_cuenta_a." de ".$rows->rc_nombre_titular_a." C.I:".$rows->ct_ced_rif_a; 
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
	$montogc = (!isset($montogc)) ? set_value('montogc') : $montogc;
	$montotasa = (!isset($montotasa)) ? set_value('montotasa') : $montotasa;
	$montofee = (!isset($montofee)) ? set_value('montofee') : $montofee;
	$montoprom = (!isset($montoprom)) ? set_value('montoprom') : $montoprom;
	$montotot = (!isset($montotot)) ? set_value('montotot') : $montotot;
	$ctaenvio = (!isset($ctaenvio)) ? set_value('ctaenvio') : $ctaenvio;
	$gcselect = (!isset($gcselect)) ? NULL : $gcselect;	
	$idgc = (!isset($idgc)) ? set_value('idgc') : $idgc;
	//$datosgc=$datosgc;
	
}

?>
<div class="container">
	<div class="row align-items-start">
		<div class="col-4 col-md-4">
			<div class="panel panel-success">
				<div class="panel-heading" align="center">
			    	<h2 class="panel-title" ><?php echo $panel_title ?></h2>
				</div>
			
			<div class="panel-body" align="center">	
			<?php  	foreach ($datosgc as $row) { ?>	  	
			  	<img src="<?php echo base_url().$row->ruta ?>" width="50%" class="img-thumbnail" onclick="javascript: document.getElementById('idgc').value='<?php echo $row->gf_id_gifcard_i_pk ?>'; document.all.miform.submit()">

			 <?php } ?>

			 </div>
			</div>

		</div>
		<div class="col-6 col-md-8">	
			<div class="panel panel-success">
			  <div class="panel-heading" align="center">
			    <h2 class="panel-title" ><?php echo $panel_title1 ?></h2>
			  </div>

			  <div class="panel-body" align="center">
			    <?php  if (validation_errors()) { echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>'; }  ?> 
			    <div id="message"></div>
			    <?php echo form_open($target, 'name="miform"') ?> 
			    <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control" id="id" >
			    <input type="hidden" name="idgc" value="<?php echo $idgc ?>" class="form-control" id="idgc" >
			    <?php if ($idgc!="") {?>
			    <div class="form-row" align="center">
			    	<img src="<?php echo base_url().$gcselect ?>" width="30%" class="img-thumbnail" title="Tarjeta Selecionada">
			    </div>
				<?php } ?>

			  <!--div class="form-group" align="left"-->
			  	<div class="form-row" align="left">
	    			<div class="form-group col-md-6">
					    <label for="Gift_card">Monto Gift Card</label>
					    <input type="text" name="montogc" value="<?php echo $montogc ?>" class="form-control" id="montogc" placeholder="Seleccione Tarjeta a la Derecha"readonly>
					</div>
					<div class="form-group col-md-6">
					    <label for="txmontotasa">Tasa Actual</label>
					    <input type="text" name="montotasa" value="<?php echo $montotasa ?>" class="form-control" id="montotasa" placeholder="Monto de la tasa" readonly>
					</div>
			  	</div>
			  <div class="form-row" align="left">
				  <div class="form-group col-md-6" align="left">
				    <label for="montofee">Monto de Fee (Calculo al <?php echo $porcfee; ?>%)</label>
				    <input type="text" name="montofee" value="<?php echo $montofee ?>" class="form-control" id="montofee" placeholder="Seleccione Tarjeta para calculo..." readonly>
					</div>

				    <div class="form-group col-md-6" align="left">
				    	<label for="montotot">Monto Total</label>
			    		<input type="text" name="montotot" value="<?php echo $montotot ?>" class="form-control" id="montotot" placeholder="Seleccione Tarjeta para calculo..." readonly>  
				    <!--label for="montofee">Monto de promocion (Calculo al ##%)</label>
				    <input type="text" name="montoprom" value="<?php echo $montoprom ?>" class="form-control" id="montoprom" placeholder="Seleccione Tarjeta para calculo..." -->  
				  </div>
			  </div>
			  <!--div class="form-group col-md-12" align="left">
			  	<label for="montotot">Monto Total</label>
			    <input type="text" name="montotot" value="<?php echo $montotot ?>" class="form-control" id="montotot" placeholder="Seleccione Tarjeta para calculo..." readonly> onclick="document.all.miform.action='transacciongift/insertartrans'" 
			  </div-->
			  <div class="form-group col-md-12" align="left">
			  	<label for="txctaenvio">Seleccione cuenta de envio</label>
			    <?php echo form_dropdown('ctaenvio',$selctas,$ctaenvio,'class="form-control"') ?>
			    
			  </div>
			<input  type="submit" name="registrogc"  class="btn btn-success" value="<?php echo $boton ?>"></button>
			  <!--button type="submit" name="bregistrogc"  class="btn btn-success"><?php echo $boton ?></button-->
			
				<?php echo form_close(); ?> 
			  </div>
			</div>
		
		</div>
	</div>
</div>

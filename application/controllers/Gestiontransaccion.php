<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Gestiontransaccion extends CI_Controller {
	private $uploaderr="";
	private $usuarioadm="";
	public function  __construct() {

		parent::__construct();
		if ($_SESSION["sess"]=='') {
			redirect(base_url().'index.php');
		}
		// load Pagination library
        $this->load->library('pagination');
        $this->load->helper(array('download', 'file', 'url', 'html', 'form'));
        // load model
		$this->load->model('Transacciongc_model');
		$this->load->model('Usuarioadm_model');
		$this->load->model('Gestiontransferencia_model');
		$this->load->model('Gestionasignacion_model');
		$this->load->model('Cuentaenvio_model');
		$this->usuarioadm=$this->Usuarioadm_model->getUsuarioadm($_SESSION['useid']);

	}
	/**
	*Display de registro de Transacciones
	*/
	public function listadoDisplay($sttrans = FALSE)
	{ 
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Consulta y Gestion de Transacciones";
		$data->sttrans=$sttrans;
		$data->titletabs=$this->Transacciongc_model->getcountTransaccionesxEstatus();

		foreach ($data->titletabs as $row) {
			$totalxst[$row->id]=  $row->total;
		}
		/*********************CONFIGURANDO PAGINACION**************************/
        // init params
        $data->params = array();
        $limit_per_page = 4;
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $totalxst[$sttrans];
        // get current page records
        $data->datos = $this->Transacciongc_model->getTransacciongcxStatusxpagina($sttrans,$limit_per_page, $start_index);
        //configuracion de la paginacion CON STYLE BOOTSTRAP
        $config['full_tag_open'] = '<ul class="pagination pagination-md">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><span>';
		$config['cur_tag_close'] = '<span></span></span></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['first_link'] = '<span class="glyphicon glyphicon-backward"></span>';
		$config['prev_link'] = '<span class="glyphicon glyphicon-chevron-left"></span>';
		$config['last_link'] = '<span class="glyphicon glyphicon-forward"></span>';
		$config['next_link'] = '<span class="glyphicon glyphicon-chevron-right"></span>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>'; 
        $config['base_url'] = base_url() . 'index.php/gestiontransaccion/listadodisplay/'.$sttrans;
        $config['total_rows'] = $total_records;
        $config['per_page'] = $limit_per_page;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config);
        // build paging links
        $data->params["links"] = $this->pagination->create_links();
        $data->start_index = $start_index;
        /******************FIN DE LA PAGINACION********************/
		
		$data->contenido = "gestiontrans/vertransacciones"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de registro de Transacciones
	*/
	public function listadoTransacciones($sttrans = FALSE)
	{ 
		$sttrans= (isset($sttrans)) ? $sttrans = urldecode($sttrans) : '';
		//$sttrans=(preg_match('/,/', $sttrans)) ? urlencode($sttrans) : $sttrans;
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Consulta y Gestion de Transacciones";
		
		$data->titletabs=$this->Transacciongc_model->getcountTransaccionesxEstatuscliente($_SESSION['useid']);
		if (count($data->titletabs)==0) {
			$this->session->set_flashdata("mensaje_exito","No tiene transacciones creadas");
			redirect(base_url()."index.php/giftcard");
		}
		foreach ($data->titletabs as $row) {
			$totalxst[$row->id]=  $row->total;
			if ($sttrans=='') { $sttrans=$row->id; };
		}
		$data->sttrans=$sttrans;
		/*********************CONFIGURANDO PAGINACION**************************/
        // init params
        $data->params = array();
        $limit_per_page = 4;
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $totalxst[$sttrans];
        // get current page records
        $data->datos = $this->Transacciongc_model->getTransacciongcxStatusxpaginaxusuario($sttrans,$limit_per_page, $start_index,$_SESSION['useid']);
        $page=(preg_match('/,/', $sttrans)) ? urlencode($sttrans) : $sttrans;
        //configuracion de la paginacion CON STYLE BOOTSTRAP
        $config['full_tag_open'] = '<ul class="pagination pagination-md">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><span>';
		$config['cur_tag_close'] = '<span></span></span></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['first_link'] = '<span class="glyphicon glyphicon-backward"></span>';
		$config['prev_link'] = '<span class="glyphicon glyphicon-chevron-left"></span>';
		$config['last_link'] = '<span class="glyphicon glyphicon-forward"></span>';
		$config['next_link'] = '<span class="glyphicon glyphicon-chevron-right"></span>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>'; 
        $config['base_url'] = base_url()."index.php/gestiontransaccion/listadoTransacciones/".$page;
        $config['total_rows'] = $total_records;
        $config['per_page'] = $limit_per_page;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config);
        // build paging links
        $data->params["links"] = $this->pagination->create_links();
        $data->start_index = $start_index;
        /******************FIN DE LA PAGINACION********************/
		
		$data->contenido = "gestiontrans/transacciones"; //archivo en view
		$this->load->view('home',$data);
	}

	/**
	*Formulario de atencion de transacciones
	* //aqui debo traerme el fee y la tasa relacionada en ese momento fecha de registro de trans
	*/

	public function atencionTransaccion($id) {
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Gestion de Transacciones";
		$data->id=$id;
		$data->porcfee="5"; 
		$data->target = "gestiontransaccion/procesartransaccion";
		$data->contenido = "gestiontrans/atenciontrans"; //archivo en view
		$data->selanalistas=$this->Usuarioadm_model->getUsuarioadmxRol(2); //se paso el parametro 2 = administrador tipo analista
		$data->datostrans=$this->Transacciongc_model->getTransacciongc($id);
		$data->dataasignacion=$this->Gestionasignacion_model->getAnalistaAsignadoxTrans($id);
		$data->idrol=$this->usuarioadm[0]->us_id_a_pk;
		$data->costatus=$data->datostrans[0]->tg_codigo_estatus_i;
		//$data->fpath=$data->analista[0]->fpath;

		$this->load->view('home',$data);

		}

		/**
	*Formulario de ver de transaccion
	*Usada solamente para usuarios comunes 
	* //aqui debo traerme el fee y la tasa relacionada en ese momento fecha de registro de trans
	*/

	public function VerTransaccion($id) {
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Gestion de Transacciones";
		$data->id=$id;
		$data->porcfee="5"; 
		$data->contenido = "gestiontrans/vertransaccion"; //archivo en view
		$data->transaccion= $this->Transacciongc_model->getTransacciongc($id);
		if ($data->transaccion[0]->tg_codigo_estatus_i==4) {
			$data->dataasignacion = $this->Transacciongc_model->getTransacciongcAsignada($id);
		}
		if ($data->transaccion[0]->tg_codigo_estatus_i==5) {
			$data->datoscuenta = $this->Cuentaenvio_model->getCuentaenvio($data->transaccion[0]->tg_cuenta_envio_a);
		}
		$this->load->view('home',$data);
		}

	/**
	*Formulario de atencion de transacciones
	* //aqui debo traerme el fee y la tasa relacionada en ese momento fecha de registro de trans
	*/

	public function procesarTransaccion() {
		/*OJO: submit tiene los valores: Asignar COD 2, En progreso cod 3, Ejecutado Cod 8,  Cancelar */
		$nrotransaccion=$this->input->post('id');
		$idanalistaactual=$this->Gestionasignacion_model->getAnalistaAsignadoxTrans($nrotransaccion);
		$idsesion=$_SESSION['sess'];
		switch ($this->input->post('submit')) {
			/////////////////ASIGNAR TRANSACCION 
			case 'Asignar':
				$this->form_validation->set_rules('idanalista', 'Analista VerumCard', 'required', 'is_natural_no_zero');
				$this->form_validation->set_message('is_natural_no_zero', 'Seleccione una opcion de %s');
				$this->form_validation->set_message('required', 'Debe seleccionar algun %s para asignar');
				
				if ($this->form_validation->run() == FALSE) {
			            $this->atencionTransaccion($nrotransaccion);//load->view('login');
			        } else {
			        	$idanalista=$this->input->post('idanalista');
			        	if ($this->Gestionasignacion_model->insertarAsignacion($nrotransaccion,$idanalista,$idsesion)) {
			        		$this->Transacciongc_model->actualizarTransacciongc($nrotransaccion,2);//estatus en ASIGNADO
			        		$this->session->set_flashdata("mensaje_exito","Se ha asignado transaccion exitosamente");
			        		redirect(base_url().'index.php/gestiontransaccion/listadodisplay/1');
			        	} else {
			        		$this->session->set_flashdata("mensaje_error","Fallo la ejecucion de asignacion");
			        		redirect(base_url().'index.php/gestiontransaccion/listadodisplay/1');
			        	}

			        }
				break;

			////////////////REASIGNAR TRANSACCION
			case 'Reasignar':
				$this->form_validation->set_rules('idanalista', 'Analista VerumCard', 'required', 'is_natural_no_zero');
				$this->form_validation->set_message('is_natural_no_zero', 'Seleccione una opcion de %s');
				$this->form_validation->set_message('required', 'Debe seleccionar algun %s para asignar');
				
				if ($this->form_validation->run() == FALSE) {
			            $this->atencionTransaccion($nrotransaccion);//load->view('login');

			        } else {
			        	$idanalista=$this->input->post('idanalista');
			        	if ($idanalista==$idanalistaactual[0]->idusuario) { //aqui valido si no selecciona analista diferente
			        		$this->session->set_flashdata("mensaje_exito","No se ha seleccionado analista diferente<br>No se ejecuto ninguna accion");
			        		redirect(base_url().'index.php/gestiontransaccion/listadodisplay/1');
			        	} else {

				        	if ($this->Gestionasignacion_model->actualizarAsignacion($nrotransaccion,$idanalista,$idsesion)) {
				        		$this->session->set_flashdata("mensaje_exito","Se ha Reasignado transaccion exitosamente");
				        		$this->Transacciongc_model->actualizarTransacciongc($nrotransaccion,2);//estatus en ASIGNADO
				        		redirect(base_url().'index.php/gestiontransaccion/listadodisplay/1');
				        	} else {
				        		$this->session->set_flashdata("mensaje_error","Fallo la ejecucion de Reasignacion");
				        		redirect(base_url().'index.php/gestiontransaccion/listadodisplay/1');
				        	}
				        }

			        }
				break;
			
			case 'Ejecutar':
				$this->form_validation->set_rules('nutransferencia', 'Numero de Transferencia', 'required|min_length[5]|max_length[20]');
				$this->form_validation->set_message('required', 'Por favor colocar dato de %s ');
        		$this->form_validation->set_message('min_length', 'Colocar un %s con mas de %s carácteres');
        		$this->form_validation->set_message('max_length', 'Colocar un %s con menos de %s carácteres');
        		$nutransferencia=$this->input->post('nutransferencia');
        		$analistaadmin=$_SESSION['useid'];
        		if ($this->form_validation->run() == FALSE) {		////valido datos de entrada
        			$this->atencionTransaccion($nrotransaccion);//load->view('login');
        		} else {
        			$fileruta=$this->cargarPdfTransaccion($nrotransaccion); ////cargo archivo 
        			//echo $fileruta;
        			if ($fileruta) {			///valida si carga el archivo
        				if (isset($idanalistaactual[0]->idasignacion)) {  ////valida si tiene asignacion
        					$idasignacion=$idanalistaactual[0]->idasignacion;
        					$monto = $idanalistaactual[0]->monto;
        					if ($analistaadmin!=$idanalistaactual[0]->idusuario) { //si un administrador realiza el caso sobre un analista
        						$this->Gestionasignacion_model->actualizarAsignacion($nrotransaccion,$analistaadmin,$idsesion);
        						$nuevaasig=$this->Gestionasignacion_model->getAnalistaAsignadoxTrans($nrotransaccion);
        						$idasignacion=$nuevaasig[0]->idasignacion;
        					}
	        				$this->Gestiontransferencia_model->insertarGestiontrans($monto,$idasignacion,$fileruta,'ejecutado',$idsesion,$nutransferencia);
	        				$this->Transacciongc_model->actualizarTransacciongc($nrotransaccion,4);//estatus en ejecutado
	        				$this->session->set_flashdata("mensaje_exito","Se ha puesto la transaccion en estado Ejecutada");
	        				redirect(base_url().'index.php/gestiontransaccion/listadodisplay/1');

        				} else { 			//si no tiene asignacion
        					$this->Gestiontrans_model->insertarAsignacion($nrotransaccion,$analistaadmin,$idsesion); //crea asignacion
        					$datoasignacion=$this->Gestiontrans_model->getAnalistaAsignadoxTrans($nrotransaccion); // obtiene datos de nueva asignacion
        					$idasignacion=$datoasignacion[0]->idasignacion;
        					$monto = $datoasignacion[0]->monto;
        					$this->Gestiontransferencia_model->insertarGestiontrans($monto,$idasignacion,$fileruta,'ejecutado',$idsesion,$nutransferencia); //inserta datos de transferencia en estatus ejecutado
        					$this->Transacciongc_model->actualizarTransacciongc($nrotransaccion,4);//estatus en ejecutado de transaccion
        					$this->session->set_flashdata("mensaje_exito","Se ha puesto la transaccion en estado Ejecutada");
	        				redirect(base_url().'index.php/gestiontransaccion/listadodisplay/1');
        				}
        			} else {
        				$this->form_validation->set_message('archivo', 'Error Message'.$this->uploaderr);
        				$this->form_validation->run();
        				$this->session->set_flashdata("mensaje_error","Fallo en la carga de archivo".$this->uploaderr);
				        redirect(base_url().'index.php/gestiontransaccion/atencionTransaccion/'.$nrotransaccion);
        			}

        		}
				break;

			case 'Cancelar':
				$this->form_validation->set_rules('txcancelar', 'Explicacion de Cancelacion', 'required|min_length[5]|max_length[20]');
				$this->form_validation->set_message('required', 'Por favor colocar  %s ');
        		$this->form_validation->set_message('min_length', 'Colocar una %s con mas de %s carácteres');
        		$this->form_validation->set_message('max_length', 'Colocar una %s con menos de %s carácteres');
				if ($this->form_validation->run() == FALSE) {		////valido datos de entrada
        			$this->atencionTransaccion($nrotransaccion);//load->view('login');
        		} else {
        			$txcancelacion=$this->input->post('txcancelar');
        			$fileruta="N/A";
        			$analistaadmin=$_SESSION['useid'];
        			if (isset($idanalistaactual[0]->idtransferencia)) {  ////valida si tiene asignacion
        					$idasignacion=$idanalistaactual[0]->idasignacion;
        					$idtransferencia=$idanalistaactual[0]->idtransferencia;
        					$monto = $idanalistaactual[0]->monto;
        					//Valida si ya tiene alguna transferencia registrada
        					$datatransfer=$this->Gestiontransferencia_model->getnumTransferenciaxasignacion($idasignacion);//OJO EVALUAR SI INGRESAR UNO NUEVO
        					if (isset($datatransfer[0]->gt_id_gestion)) { // evalua transferencia
        						$idtransfer=$datatransfer[0]->gt_id_gestion;
        						$this->Gestiontransferencia_model->cancelarTransferencia($idtransfer,$txcancelacion);
        						$this->Transacciongc_model->actualizarTransacciongc($nrotransaccion,5);//estatus en cancelado
        						$this->session->set_flashdata("mensaje_exito","Se ha cancelado transaccion exitosamente");
			        			redirect(base_url().'index.php/atenciontrans');
        					} else {
        						if ($analistaadmin!=$idanalistaactual[0]->idusuario) { //si un administrador realiza el caso sobre un analista
	        						$this->Gestionasignacion_model->actualizarAsignacion($nrotransaccion,$analistaadmin,$idsesion);
	        						$nuevaasig=$this->Gestionasignacion_model->getAnalistaAsignadoxTrans($nrotransaccion);
	        						$idasignacion=$nuevaasig[0]->idasignacion;
        						}
        						$this->Gestiontransferencia_model->insertarGestiontrans($monto,$idasignacion,$fileruta,'cancelado',$idsesion,'');
        						$datatransfer=$this->Gestiontransferencia_model->getnumTransferenciaxasignacion($idasignacion);
        						$idtransfer=$datatransfer[0]->gt_id_gestion;
		        				$this->Gestiontransferencia_model->cancelarTransferencia($idtransfer,$txcancelacion);
		        				$this->Transacciongc_model->actualizarTransacciongc($nrotransaccion,5);//estatus en cancelado
								$this->session->set_flashdata("mensaje_exito","Se ha cancelado transaccion exitosamente");
								redirect(base_url().'index.php/atenciontrans');
        					}

	        				
        				} else { 			//si no tiene asignacion (ES PORQUE ES UN ADMINISTRADOR P SUPERVISOR)
        					$analistaadmin=$_SESSION['useid'];
        					$this->Gestionasignacion_model->insertarAsignacion($nrotransaccion,$analistaadmin,$idsesion); //crea asignacion
        					$datoasignacion=$this->Gestionasignacion_model->getAnalistaAsignadoxTrans($nrotransaccion); // obtiene datos de nueva asignacion
        					$idasignacion=$datoasignacion[0]->idasignacion;
        					$monto = $datoasignacion[0]->monto;

        					//$idtransferencia=$datoasignacion[0]->idtransferencia;
        					$this->Gestiontransferencia_model->insertarGestiontrans($monto,$idasignacion,$fileruta,'cancelado',$idsesion,''); //inserta datos de transferencia en estatus ejecutado
        					$datatransfer=$this->Gestiontransferencia_model->getnumTransferenciaxasignacion($idasignacion);
        					$idtransfer=$datatransfer[0]->gt_id_gestion;
        					$this->Gestiontransferencia_model->cancelarTransferencia($idtransfer,$txcancelacion);
        					$this->Transacciongc_model->actualizarTransacciongc($nrotransaccion,5);//estatus en cancelado
        					$this->session->set_flashdata("mensaje_exito","Se ha cancelado transaccion exitosamente");
			        		redirect(base_url().'index.php/atenciontrans');
        				}
        		}
				break;

		}

	}

	public function correccionTransaccion($id) { 
		$this->form_validation->set_rules('nucuenta', 'numero de cuenta', 'required|min_length[20]|max_length[20]');
		$this->form_validation->set_rules('idnac', 'Tipo ID', 'required|min_length[1]|max_length[1]');
		$this->form_validation->set_rules('cititular', 'Cedula o Rif', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('nbtitular', 'Nombre de titular de cuenta', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('email', 'Correo electronico', 'required|valid_email');
		
		//mensaje para validaciones
		$this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('min_length', 'El %s debe tener al menos mas de %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s debe tener menos de %s carácteres');
        $this->form_validation->set_message('valid_email', 'El %s debe ser formato valido');
		if ($this->form_validation->run() == FALSE)
        {
                $this->vertransaccion($this->input->post('id'));//load->view('login');
        } else {
        	$idcta=$this->input->post('idcta');
        	$nucuenta=$this->input->post('nucuenta');
        	$prefnac=$this->input->post('idnac');
        	$cedulatit=$this->input->post('cititular');
        	$nbtit=$this->input->post('nbtitular');
        	$email=$this->input->post('email');
        	if ($this->Cuentaenvio_model->correccionCuentaenvio($idcta,$nucuenta,$prefnac,$cedulatit,$nbtit,$email)) {
        		$this->Transacciongc_model->actualizarTransacciongc($id,2);
        		$asignacion=$this->Gestionasignacion_model->getnumAsignacionxTransaccion($id);
        		$idasignacion=$asignacion[0]->as_id_asignacion;
        		$datatransfer=$this->Gestiontransferencia_model->getnumTransferenciaxasignacion($idasignacion);
        		$idtransferencia=$datatransfer[0]->gt_id_gestion;
        		$this->Gestiontransferencia_model->correccionTransferencia($idtransferencia);
        		$this->session->set_flashdata("mensaje_exito","La Cuenta de envio  ha sido Corregida y se envio nuevamente la transaccion");
			    redirect(base_url().'index.php/transacciones');

			}
        }

	}

	public function cargarPdfTransaccion($idtrans) {
        // set path to store uploaded files
        $config['upload_path'] = './assets/files/uploads';
        // set allowed file types
        $config['allowed_types'] = 'pdf|gif|jpg|jpeg|png';
        // set upload limit, set 0 for no limit
        $config['max_size']    = 0;
	    //$mi_imagen = $archivo;//$archivo['tmp_name'];//'mi_imagen';
	    $config['file_name'] = $idtrans;
	    $config['overwrite'] = FALSE;
	    // set upload limit, set 0 for no limit


	    $this->load->library('upload', $config);

	    if (!$this->upload->do_upload('archivo')) {
	        //*** ocurrio un error
	        $data['uploadError'] = $this->upload->display_errors();
	        //echo $this->upload->display_errors();
	        $this->uploaderr=$this->upload->display_errors();
	        return FALSE;
	    }

	    $data['uploadSuccess'] = $this->upload->data();
	    //print_r($data);
	    $rutaimg=$data['uploadSuccess']['file_name'];
	    return $rutaimg;
	    //$this->Giftcardadm_model->insertarGiftcardadmImg($id,$rutaimg,$_SESSION['sess']);
    }
    public function downloads($name){
        
       $data = file_get_contents(base_url('/assets/files/uploads/'.$name));
       force_download($name,$data);
       $this->atencionTransaccion($this->input->post('id'));
    
}
    /*    /*
     * file value and type check during validation
     *
    public function file_check($str){
        $allowed_mime_type_arr = array('application/pdf','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['file']['name']);
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }*/

}


?>
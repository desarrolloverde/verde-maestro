<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Gestiontransaccion extends CI_Controller {
	private $uploaderr="";
	public function  __construct() {

		parent::__construct();
		if ($_SESSION["sess"]=='') {
			redirect(base_url().'index.php');
		}
		// load Pagination library
        $this->load->library('pagination');
        // load Transaccciongc_model
		$this->load->model('Transacciongc_model');
		$this->load->model('Usuarioadm_model');
		$this->load->model('Gestiontrans_model');

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
		$config['last_link'] = '<span class="glyphicon glyphicon-backward"></span>';
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
	public function listadoDisplayUsuario($sttrans = FALSE)
	{ 
		$sttrans = urldecode($sttrans);
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Consulta y Gestion de Transacciones";
		$data->sttrans=$sttrans;
		$data->titletabs=$this->Transacciongc_model->getcountTransaccionesxEstatuscliente();

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
		$config['last_link'] = '<span class="glyphicon glyphicon-backward"></span>';
		$config['next_link'] = '<span class="glyphicon glyphicon-chevron-right"></span>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>'; 
        $config['base_url'] = base_url() . 'index.php/gestiontransaccion/listadoDisplayUsuario/'.urlencode($sttrans);
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
		$data->analista=$this->Gestiontrans_model->getAnalistaAsignadoxTrans($id);
		$this->load->view('home',$data);

	}

	/**
	*Formulario de atencion de transacciones
	* //aqui debo traerme el fee y la tasa relacionada en ese momento fecha de registro de trans
	*/

	public function procesarTransaccion() {
		/*OJO: submit tiene los valores: Asignar COD 2, En progreso cod 3, Ejecutado Cod 8,  Cancelar */
		$nrotransaccion=$this->input->post('id');
		$idanalista=$this->input->post('idanalista');
		$idanalistaactual=$this->Gestiontrans_model->getAnalistaAsignadoxTrans($nrotransaccion);
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
			        	if ($this->Gestiontrans_model->insertarAsignacion($nrotransaccion,$idanalista,$idsesion)) {
			        		$this->session->set_flashdata("mensaje_exito","Se ha asignado transaccion exitosamente");
			        		$this->Transacciongc_model->actualizarTransacciongc($nrotransaccion,2);//estatus en ASIGNADO
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
			        	if ($idanalista==$idanalistaactual[0]->idusuario) { //aqui valido si no selecciona analista diferente
			        		$this->session->set_flashdata("mensaje_exito","No se ha seleccionado analista diferente<br>No se ejecuto ninguna accion");
			        		redirect(base_url().'index.php/gestiontransaccion/listadodisplay/1');
			        	} else {

				        	if ($this->Gestiontrans_model->actualizarAsignacion($nrotransaccion,$idanalista,$idsesion)) {
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
        		if ($this->form_validation->run() == FALSE) {		////valido datos de entrada
        			$this->atencionTransaccion($nrotransaccion);//load->view('login');
        		} else {
        			$fileruta=$this->cargarPdfTransaccion($nrotransaccion); ////cargo archivo pdf
        			//echo $fileruta;
        			if ($fileruta) {			///valida si carga el archivo
        				if (isset($idanalistaactual[0]->idasignacion)) {  ////valida si tiene asignacion
        					$idasignacion=$idanalistaactual[0]->idasignacion;
        					$monto = $idanalistaactual[0]->monto;
	        				$this->Gestiontrans_model->insertarGestiontrans($monto,$idasignacion,$fileruta,'ejecutado',$idsesion,$nutransferencia);
	        				$this->Transacciongc_model->actualizarTransacciongc($nrotransaccion,4);//estatus en ejecutado
        				} else { 			//si no tiene asignacion
        					$analistaadmin=$_SESSION['useid'];
        					$this->Gestiontrans_model->insertarAsignacion($nrotransaccion,$analistaadmin,$idsesion); //crea asignacion
        					$datoasignacion=$this->Gestiontrans_model->getAnalistaAsignadoxTrans($nrotransaccion); // obtiene datos de nueva asignacion
        					$idasignacion=$datoasignacion[0]->idasignacion;
        					$monto = $datoasignacion[0]->monto;
        					$this->Gestiontrans_model->insertarGestiontrans($monto,$idasignacion,$fileruta,'ejecutado',$idsesion,$nutransferencia); //inserta datos de transferencia en estatus ejecutado
        					$this->Transacciongc_model->actualizarTransacciongc($nrotransaccion,4);//estatus en ejecutado de transaccion
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
        			$fileruta="";
        			if (isset($idanalistaactual[0]->idtransferencia)) {  ////valida si tiene asignacion
        					$idasignacion=$idanalistaactual[0]->idasignacion;
        					$idtransferencia=$idanalistaactual[0]->idtransferencia;
        					$monto = $idanalistaactual[0]->monto;
	        				$this->Gestiontrans_model->insertarGestiontrans($monto,$idasignacion,$fileruta,'cancelado',$idsesion,$nutransferencia);
	        				$this->Gestiontrans_model->cancelarTransferencia($idtransferencia,$txcancelacion);
	        				$this->Transacciongc_model->actualizarTransacciongc($nrotransaccion,5);//estatus en ejecutado
        				} else { 			//si no tiene asignacion
        					$analistaadmin=$_SESSION['useid'];
        					$this->Gestiontrans_model->insertarAsignacion($nrotransaccion,$analistaadmin,$idsesion); //crea asignacion
        					$datoasignacion=$this->Gestiontrans_model->getAnalistaAsignadoxTrans($nrotransaccion); // obtiene datos de nueva asignacion
        					$idasignacion=$datoasignacion[0]->idasignacion;
        					$monto = $datoasignacion[0]->monto;
        					$idtransferencia=$datoasignacion[0]->idtransferencia;
        					$this->Gestiontrans_model->insertarGestiontrans($monto,$idasignacion,$fileruta,'cancelado',$idsesion,''); //inserta datos de transferencia en estatus ejecutado
        					$this->Gestiontrans_model->cancelarTransferencia($idtransferencia,$txcancelacion);
        					$this->Transacciongc_model->actualizarTransacciongc($nrotransaccion,5);//estatus en ejecutado de transaccion
        				}
        		}
				break;

		}

	}

	public function cargarPdfTransaccion($idtrans) {
	    $this->load->helper(array('form','url'));
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
	    $rutaimg='/assets/files/uploads/'.$data['uploadSuccess']['file_name'];
	    return $rutaimg;
	    //$this->Giftcardadm_model->insertarGiftcardadmImg($id,$rutaimg,$_SESSION['sess']);
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
<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Gestiontransaccion extends CI_Controller {
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
		//$data->target="gestiontrans/gestiontransaccion";
		//$data->datos = $this->Transacciongc_model->getTransacciongcxIdestatus($sttrans);
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
		$this->load->view('home',$data);

	}

	/**
	*Formulario de atencion de transacciones
	* //aqui debo traerme el fee y la tasa relacionada en ese momento fecha de registro de trans
	*/

	public function procesarTransaccion() {
		/*OJO: submit tiene los valores: Asignar,  Ejecutar,  Cancelar */
		$nrotransaccion=$this->input->post('id');
		$idusuario=$_SESSION['useid'];
		$idsesion=$_SESSION['sess'];
		switch ($this->input->post('submit')) {
			case 'Asignar':
				$this->form_validation->set_rules('idanalista', 'Analista VerumCard', 'required');
				if ($this->form_validation->run() == FALSE)
			        {
			            $this->atencionTransaccion($this->input->post('id'));//load->view('login');
			        } else {

			        	if ($this->Gestiontrans_model->insertarAsignacion($nrotransaccion,$idusuario,$idsesion)) {
			        		$this->session->set_flashdata("mensaje_exito","Se ha asignado transaccion satisfactoriamente");
			        		$this->Transacciongc_model->actualizarTransacciongc($nrotransaccion,2);//estatus en proceso
			        		redirect(base_url().'index.php/gestiontransaccion/listadodisplay/1');
			        	} else {
			        		$this->session->set_flashdata("mensaje_error","Fallo la ejecucion de asignacion");
			        		redirect(base_url().'index.php/gestiontransaccion/listadodisplay/1');
			        	}

			        }
				break;
			
			case 'Ejecutar':
				
				break;

			case 'Cancelar':
				# code...
				break;

		}

		
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Gestion de Transacciones";
		$data->porcfee="5"; 
		$data->target = "gestiontransaccion/procesartransaccion";//esto es para probar
		$data->contenido = "gestiontrans/atenciontrans"; //archivo en view 
		$data->selanalistas=$this->Usuarioadm_model->getUsuarioadmxRol(2); //se paso el parametro 2 = administrador tipo analista
		$data->datostrans=$this->Transacciongc_model->getTransacciongc($id);
		$this->load->view('home',$data);

	}


	public function calculoFee($montogf) {
				$totalcambiario = $montogf * $this->Tasa_model->getTasaxMonedaActiva(1);
				return ($totalcambiario/100) * $this->Fee_model->getFeeActivo();

	}

	public function montoTotal($montogf) {
		return $totalcambiario = ($montogf * $this->Tasa_model->getTasaxMonedaActiva(1)) - $this->calculoFee($montogf);
	}
}


?>
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

	}
	/**
	*Display de registro de Transacciones
	*/
	public function listadoDisplay($sttrans = FALSE)
	{ 
		$data = new stdClass();
		
		$data->title = "VerumCard";
		$data->panel_title = "Consulta y Gestion de Transacciones";
		$data->target="gestiontrans/gestiontransaccion";
		//$data->datos = $this->Transacciongc_model->getTransacciongcxIdestatus($sttrans);
		$data->sttrans=$sttrans;
		$data->titletabs=$this->Transacciongc_model->getcountTransaccionesxEstatus();

		foreach ($data->titletabs as $row) {
			$totalxst[$row->id]=  $row->total;
		}
		//$data->segment=$this->uri->segment(2);

		/*********************PROBANDO PAGINACION**************************/
        // init params
        $data->params = array();
        $limit_per_page = 4;
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $totalxst[$sttrans];

        // get current page records
        $data->datos = $this->Transacciongc_model->getTransacciongcxStatusxpagina($sttrans,$limit_per_page, $start_index);
        //configuracion bootstrap de la paginacion
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
        

		
		$data->contenido = "gestiontrans/vertransacciones"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de registro de Transacciones
	*/

	public function calculoFee($montogf) {
				$totalcambiario = $montogf * $this->Tasa_model->getTasaxMonedaActiva(1);
				return ($totalcambiario/100) * $this->Fee_model->getFeeActivo();

	}

	public function montoTotal($montogf) {
		return $totalcambiario = ($montogf * $this->Tasa_model->getTasaxMonedaActiva(1)) - $this->calculoFee($montogf);
	}
}


?>
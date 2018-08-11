<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Tasa extends CI_Controller {
	public function  __construct() {

		parent::__construct();
		if ($_SESSION["sess"]=='') {
			redirect(base_url().'index.php');
		}
		$this->load->model('Tasa_model');
		$this->load->model('Moneda_model');
	}
	/**
	*Display de registro de usuario
	*/
	public function registroDisplay()
	{
		
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Registro de Tasa de Valor de Moneda";
		$data->panel_title1 = "Listado de los ultimos registros <br>Tasa de Valor de Moneda";
		$data->isadmin = true;
		$data->contenido = "calculosadm/tasa_adm"; //archivo en view
		$data->boton = "Insertar Tasa"; 
		//
		$data->target = "tasa/insertarTasa"; 
		$data->datossel = $this->Moneda_model->getMonedasActiva();
		$data->moneda  = ($this->input->post('moneda')) ? $this->input->post('moneda') : $data->datossel[0]->mn_id_moneda_a_pk;
		$data->datos = $this->Tasa_model->getTasasxMoneda($data->moneda);
		$this->load->view('home',$data);
	}
	
	

	/**
	*Controlador para registro de tasas
	*/
	public function insertarTasa(){
		$this->form_validation->set_rules('tasa', 'Tasa Cambiaria', 'required|min_length[3]|max_length[7]','numeric');
		//mensaje para validaciones
		$this->form_validation->set_message('required', 'La %s es requerido');
        $this->form_validation->set_message('min_length', 'La %s debe tener al menos mas de %s carácteres');
        $this->form_validation->set_message('max_length', 'La %s debe tener menos de %s carácteres');
        $this->form_validation->set_message('numeric', 'La %s debe ser solo numeros');
		if ($this->form_validation->run() == FALSE)
        {
                $this->registroDisplay();//load->view('login');
        }
        else
        {
        	//if (isset($this->input->post)) {
	        	$tasa  = $this->input->post('tasa');
	        	$idmoneda  = $this->input->post('fidmoneda'); 
	        	$ejecucion=$this->Tasa_model->insertarTasa($tasa,$idmoneda,$_SESSION['sess']);
	        	if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","La Nueva Tasa  ha sido ingresada");
			        redirect(base_url().'index.php/tasa');
		    	}
	        	
	        //}

        }

	}

	
	
}




?>
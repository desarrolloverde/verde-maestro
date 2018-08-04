<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Moneda extends CI_Controller {
	public function  __construct() {

		parent::__construct();
		if ($_SESSION["sess"]=='') {
			redirect(base_url().'index.php');
		}
		if ($_SESSION['usad']!=true) {
			redirect(base_url().'index.php');
		}
		$this->load->model('Moneda_model');
		//$this->load->model('Administrador_model');
	}
	/**
	*Display de registro de usuario
	*/
	public function registroDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Registro de Monedas";
		$data->isadmin = true;
		$data->contenido = "moneda/registro"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de registro de usuario
	*/
	public function listadoDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Listado de Monedas usadas <br>en Sistema";
		$data->isadmin = true;
		$data->datos = $this->Moneda_model->getMoneda();
		$data->contenido = "moneda/monedas"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de Modificacion
	*/
	public function editarDisplay($id)
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Editar Moneda";
		$data->isadmin = true;
		$data->datos = $this->Moneda_model->getMoneda($id);
		$data->contenido = "moneda/registro"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Controlador para registro de Moneda
	*/
	public function insertarmoneda(){
		$this->form_validation->set_rules('prefijo', 'prefijo', 'required|min_length[3]|max_length[10]');
		$this->form_validation->set_rules('descripcion', 'descripcion', 'required|min_length[10]|max_length[15]');
		$this->form_validation->set_rules('status', 'status', 'required');
		//mensaje para validaciones
		$this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('min_length', 'El %s debe tener al menos mas de %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s debe tener menos de %s carácteres');
		if ($this->form_validation->run() == FALSE)
        {
                $this->registroDisplay();//load->view('login');
        }
        else
        {
        	//if (isset($this->input->post)) {
	        	$prefijo  = $this->input->post('prefijo'); 
	        	$descripcion= $this->input->post('descripcion');
	        	$status= $this->input->post('status');
	        	$ejecucion=$this->Moneda_model->insertarMoneda($descripcion,$prefijo,$_SESSION['sess']);
	        	if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","La moneda $descripcion ha sido ingresado");
			        redirect(base_url().'index.php/moneda');
		    	}
	        	
	        //}

        }

	}
		/**
	*Display de Modificacion
	*/
	public function editarMoneda($id)
	{
		$this->form_validation->set_rules('prefijo', 'prefijo', 'required|min_length[3]|max_length[10]');
		$this->form_validation->set_rules('descripcion', 'descripcion', 'required|min_length[10]|max_length[15]');
		$this->form_validation->set_rules('status', 'status', 'required');
		//mensaje para validaciones
		$this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('min_length', 'El %s debe tener al menos mas de %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s debe tener menos de %s carácteres');
		if ($this->form_validation->run() == FALSE)
        {
                $this->editarDisplay($id);//load->view('login');
        } else {
			if($id != NULL) {
				$id  = $this->input->post('id'); 
				$prefijo  = $this->input->post('prefijo'); 
	        	$descripcion= $this->input->post('descripcion');
	        	$status= $this->input->post('status');
	        	$ejecucion=$this->Moneda_model->editarMoneda($id,$prefijo,$descripcion,$status);
	        	if ($ejecucion) { 
			        	 $this->session->set_flashdata("mensaje_exito","Modificacion Exitosa");
				        redirect(base_url().'index.php/moneda');
			    }
			} else {
				$this->listadoDisplay();	
			}
		}


	}

	//funcion para borrar Moneda
	public function borrarMoneda($id = NULL)
	{
		if($id != NULL) {
			$ejecucion=$this->Moneda_model->eliminarMoneda($id);
			if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","Eliminacion Exitosa");
			        redirect(base_url().'index.php/moneda');
		    }
		}


	}
	
}




?>
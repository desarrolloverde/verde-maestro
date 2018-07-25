<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Franquicia extends CI_Controller {
	public function  __construct() {

		parent::__construct();
		if ($_SESSION["sess"]=='') {
			redirect(base_url().'index.php');
		}
		$this->load->model('Franquicia_model');
		$this->load->model('Administrador_model');
	}
	/**
	*Display de registro de usuario
	*/
	public function registroDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Registro de Franquicias de Tarjetas";
		$data->isadmin = true;
		$data->contenido = "franquicia/registro"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de registro de usuario
	*/
	public function listadoDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Registro de Franquicias de Tarjetas";
		$data->isadmin = true;
		$data->datos = $this->Franquicia_model->getfranquicia();
		$data->contenido = "franquicia/franquicias"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de Modificacion
	*/
	public function editarDisplay($id)
	{
		$data = new stdClass();
		$data->title = "VerumCard Web Page";
		$data->panel_title = "Editar Franquicias de Tarjetas";
		$data->isadmin = true;
		$data->datos = $this->Franquicia_model->getfranquicia($id);
		$data->contenido = "franquicia/registro"; //archivo en view
		$this->load->view('home',$data);
	}

	/**
	*Controlador para registro de Banco
	*/
	public function insertarFranquicia(){
		$this->form_validation->set_rules('franquicia', 'franquicia', 'required|min_length[4]|max_length[20]');
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
	        	$franquicia  = $this->input->post('franquicia'); 
	        	$ejecucion=$this->Franquicia_model->insertarFranquicia($franquicia,$_SESSION['sess']);
	        	if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","La Franquicia $entidad ha sido ingresado");
			        redirect(base_url().'index.php/franquicia');
		    	}
	        	
	        //}

        }

	}

	//funcion para borrar banco........ la eliminacion debe ser logica
	public function borrarFranquicia($id = NULL)
	{
		if($id != NULL) {
			$ejecucion=$this->Franquicia_model->eliminarFranquicia($id);
			if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","Eliminacion Exitosa");
			        redirect(base_url().'index.php/franquicia');
		    }
		}


	}

	/**
	*Display de Modificacion
	*/
	public function editarFranquicia($id = NULL)
	{
		$this->form_validation->set_rules('franquicia', 'franquicia', 'required|min_length[4]|max_length[20]');
		//mensaje para validaciones
		$this->form_validation->set_message('required', 'La %s es requerido');
        $this->form_validation->set_message('min_length', 'La %s debe tener al menos mas de %s carácteres');
        $this->form_validation->set_message('max_length', 'La %s debe tener menos de %s carácteres');
		if ($this->form_validation->run() == FALSE)
        {
                $this->editarDisplay($id);//load->view('login');
        } else {
			if($id != NULL) {
				$franquicia  = $this->input->post('franquicia');
				$ejecucion=$this->Franquicia_model->editarFranquicia($id,$franquicia);
				if ($ejecucion) { 
			        	 $this->session->set_flashdata("mensaje_exito","Modificacion Exitosa");
				        redirect(base_url().'index.php/franquicia');
			    }
			} else {
				$this->listadoDisplay();	
			}
		}


	}
	
}




?>
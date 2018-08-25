<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Banco extends CI_Controller {
	public function  __construct() {

		parent::__construct();
		if ($_SESSION["sess"]=='') {
			redirect(base_url().'index.php');
		}
		if ($_SESSION['usad']!=true) {
			redirect(base_url().'index.php');
		}
		$this->load->model('Banco_model');
		$this->load->model('Administrador_model');
	}
	/**
	*Display de registro de usuario
	*/
	public function registroDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Registro de Entidades Bancarias";
		$data->isadmin = true;
		$data->contenido = "banco/registro"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de registro de usuario
	*/
	public function listadoDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Registro de Entidades Bancarias";
		$data->isadmin = true;
		$data->bancos = $this->Banco_model->getBancos();
		$data->contenido = "banco/bancos"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de Modificacion
	*/
	public function editarDisplay($id)
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Editar Bancos";
		$data->isadmin = true;
		$data->datos = $this->Banco_model->getBancos($id);
		$data->contenido = "banco/registro"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Controlador para registro de Banco
	*/
	public function insertarbanco(){
		$this->form_validation->set_rules('entidad', 'Nombre de la Entidad', 'required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('coentidad', 'Codigo de Entidad', 'required|min_length[4]|max_length[4]');
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
	        	$entidad  = $this->input->post('entidad'); 
	        	$coentidad= $this->input->post('coentidad');
	        	$ejecucion=$this->Banco_model->insertarBanco($entidad,$_SESSION['sess'],$coentidad);
	        	if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","El Banco $entidad ha sido ingresado");
			        redirect(base_url().'index.php/banco');
		    	}
	        	
	        //}

        }

	}
		/**
	*Display de Modificacion
	*/
	public function editarBanco($id = NULL)
	{
		$this->form_validation->set_rules('entidad', 'Nombre de la Entidad', 'required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('coentidad', 'Codigo de Entidad', 'required|min_length[4]|max_length[4]');
		//mensaje para validaciones
		$this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('min_length', 'El %s debe tener al menos mas de %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s debe tener menos de %s carácteres');
		if ($this->form_validation->run() == FALSE)
        {
                $this->editarDisplay($id);//load->view('login');
        } else {
			if($id != NULL) {
				$entidad  = $this->input->post('entidad');
				$coentidad  = $this->input->post('coentidad');
				$ejecucion=$this->Banco_model->editarBanco($id,$entidad,$coentidad);
				if ($ejecucion) { 
			        	 $this->session->set_flashdata("mensaje_exito","Modificacion Exitosa");
				        redirect(base_url().'index.php/banco');
			    }
			} else {
				$this->listadoDisplay();	
			}
		}


	}

	//funcion para borrar banco........ la eliminacion debe ser logica
	public function borrarBanco($id = NULL)
	{
		if($id != NULL) {
			$ejecucion=$this->Banco_model->eliminarBanco($id);
			if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","Eliminacion Exitosa");
			        redirect(base_url().'index.php/banco');
		    }
		}


	}
	
}




?>
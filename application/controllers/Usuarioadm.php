<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Usuarioadm extends CI_Controller {
	public function  __construct() {

		parent::__construct();
		if ($_SESSION["sess"]=='') {
			redirect(base_url().'index.php');
		}
		$this->load->model('Usuarioadm_model');
		$this->load->model('Administrador_model');
	}
	/**
	*Display de registro de usuario
	*/
	public function registroDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Registro de Usuarios administradores";
		$data->isadmin = true;
		$data->datossel = $this->Usuarioadm_model->getRoles();
		$data->contenido = "usuarioadm/registro"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de registro de usuario
	*/
	public function listadoDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Registro de Usuarios administradores ";
		$data->isadmin = true;
		$data->datos = $this->Usuarioadm_model->getUsuarioadm();
		$data->contenido = "usuarioadm/usuarioadm"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de Modificacion
	*/
	public function editarDisplay($id)
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Editar Usuario administrador";
		$data->isadmin = true;
		$data->datos = $this->Usuarioadm_model->getUsuarioadm($id);
		$data->datossel = $this->Usuarioadm_model->getRoles();
		$data->contenido = "usuarioadm/registro"; //archivo en view
		$this->load->view('home',$data);
	}

	/**
	*Controlador para registro de Banco
	$nombre,$apellido,$clave,$email,$nurol
	*/
	public function insertarUsuarioadm(){
		$this->form_validation->set_rules('nombre', 'nombre', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('apellido', 'apellido', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('clave', 'clave', 'required|min_length[4]|max_length[10]');
		$this->form_validation->set_rules('email', 'email', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('rol', 'rol', 'required');
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
        		$nombre=$this->input->post('nombre');$apellido=$this->input->post('apellido');
        		$clave=$this->input->post('clave');$email=$this->input->post('email');
        		$nurol=$this->input->post('rol');
	        	
	        	$ejecucion=$this->Usuarioadm_model->insertarUsuarioadm($nombre,$apellido,$clave,$email,$nurol);
	        	if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","El Usuarioadm $entidad ha sido ingresado");
			        redirect(base_url().'index.php/usuarioadm');
		    	}
	        	
	        //}

        }

	}

	//funcion para borrar banco........ la eliminacion debe ser logica
	public function borrarUsuarioadm($id = NULL)
	{
		if($id != NULL) {
			$ejecucion=$this->Usuarioadm_model->eliminarUsuarioadm($id);
			if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","Eliminacion Exitosa");
			        redirect(base_url().'index.php/usuarioadm');
		    }
		}


	}

	/**
	*Display de Modificacion
	*/
	public function editarUsuarioadm($id = NULL)
	{
		$this->form_validation->set_rules('nombre', 'nombre', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('apellido', 'apellido', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('clave', 'clave', 'required|min_length[4]|max_length[10]');
		$this->form_validation->set_rules('email', 'email', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('rol', 'rol', 'required');
		//mensaje para validaciones
		$this->form_validation->set_message('required', 'La %s es requerido');
        $this->form_validation->set_message('min_length', 'La %s debe tener al menos mas de %s carácteres');
        $this->form_validation->set_message('max_length', 'La %s debe tener menos de %s carácteres');
		if ($this->form_validation->run() == FALSE)
        {
                $this->editarDisplay($id);//load->view('login');
        } else {
			if($id != NULL) {
				$nombre=$this->input->post('nombre');$apellido=$this->input->post('apellido');
        		$clave=$this->input->post('clave');$email=$this->input->post('email');
        		$nurol=$this->input->post('rol');
				$ejecucion=$this->Usuarioadm_model->editarUsuarioadm($id,$nombre,$apellido,$clave,$email,$nurol);
				if ($ejecucion) { 
			        	 $this->session->set_flashdata("mensaje_exito","Modificacion Exitosa");
				        redirect(base_url().'index.php/usuarioadm');
			    }
			} else {
				$this->listadoDisplay();	
			}
		}


	}
	
}




?>
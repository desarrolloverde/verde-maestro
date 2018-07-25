<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Usuario extends CI_Controller {
	public function  __construct() {

		parent::__construct();
		$this->load->model('Usuario_model');
	}
	/**
	*Display de registro de usuario
	*/
	public function registroDisplay()
	{
		$data = new stdClass();
		$data->title = "Verum Card Web Page";
		$data->panel_title = "Registro de Usuarios";
		$data->contenido = "usuario/registro"; //archivo en view
		$this->load->view('login',$data);
	}
	/**
	*Controlador para registro de usuarioo
	*/
	public function insertarUsuario(){
		$this->form_validation->set_rules('nombres', 'nombres', 'required|min_length[5]|max_length[20]');
		$this->form_validation->set_rules('apellidos', 'apellidos', 'required|min_length[5]|max_length[20]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email','is_unique[vc_m_usuario_verumcard.uv_email_a]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
		//mensaje para validaciones
		$this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('min_length', 'El %s debe tener al menos mas de %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s debe tener menos de %s carácteres');
        $this->form_validation->set_message('valid_email', 'El %s debe tener formato de correo electronico');
        $this->form_validation->set_message('matches[password]', 'El %s coincidir con el campo %s');


		if ($this->form_validation->run() == FALSE)
        {
                $this->registroDisplay();//load->view('login');
        }
        else
        {
        	//if (isset($this->input->post)) {
	        	$nombres  = $this->input->post('nombres'); 
	        	$apellidos= $this->input->post('apellidos');
	        	$email    = $this->input->post('email');
	        	$fenacimiento=$this->input->post('fenacimiento');
	        	$password = $this->input->post('password');
	        	$passconf = $this->input->post('passconf');
	        	if ($password!=$passconf) { 
	        		$this->session->set_flashdata("mensaje_error","Deben coincidir el password y su Confirmation");
					$this->registroDisplay();//redirect(base_url().'index.php/registro');
	        	 }
	        	 	$this->session->set_flashdata("mensaje_exito","El usuario ha sido ingresado");
		        	$this->registroDisplay();
	        	$ejecucion=$this->Usuario_model->insertarUsuario($password,$nombres,$apellidos,$email,$fenacimiento);
				//echo $ejecucion; 
				if ($ejecucion) { 
					$this->session->set_flashdata("mensaje_exito","El usuario ha sido ingresado");
		        	redirect(base_url().'index.php/login');//$this->registroDisplay();
	        	}
	        //}

        }

	}
	
}




?>
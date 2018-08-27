<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacion extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *Pagina de prueba
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		//if ($_SESSION["sess"]=='') {
		//	redirect(base_url().'index.php');
		//}
		$this->load->model('Autenticacion_model');
		$this->load->model('Usuario_model');
		$this->load->model('Administrador_model');
	}
	
		
	public function login()
	{
		if (isset($_SESSION['sess'])) { redirect(base_url().'index.php/home'); }
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->contenido = "autenticacion/login";
		$data->panel_title = "Inicio de Sessiones";
		$data->tp_signin = "signin";
		$data->tp_logout = "logout";
		$data->active = "login";
		$this->load->view('login',$data);
		//$this->load->view('login'); //echo "por defectoooo hola mundo"; //$this->load->view('welcome_message');
	}
	public function loginAdministrador()
	{
		if (isset($_SESSION['sess'])) { redirect(base_url().'index.php/home'); }
		$data = new stdClass();
		$data->title = "VerumCard Administracion";
		$data->contenido = "autenticacion/login";
		$data->panel_title = "Ingreso de Modulo de Administracion";
		$data->tp_signin = "signinadm";
		$data->tp_logout = "logoutAdministrador";
		$data->active = "login";
		$this->load->view('login',$data);
		
	}
	

	public function signinAdministrador()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'required|min_length[5]|max_length[12]');
		 if ($this->form_validation->run() == FALSE)
        {
                $this->login();//load->view('login');
        }
        else
        {
			$correo = $this->input->post('email');
			$pass = $this->input->post('pass');
			$user = $this->Administrador_model->getUsuarioxEmail($correo);
			
			if (!$user) {
				$this->session->set_flashdata("mensaje_error","Usuario Invalido");
				redirect(base_url().'index.php/adm');
			}
			//aqui valido la clave de usuario
			if ($user->us_clave_a == md5($pass)) {
				$_SESSION['useid']= $user->us_id_usuario_a_pk;
				$_SESSION['user_name']= $user->us_nombre_a;	
				$this->Autenticacion_model->crearSesionAdmin($_SESSION['useid']);
				$_SESSION['feultses']=$this->Autenticacion_model->getUltimaSesion($_SESSION['useid']);
				$msg_ultconex=($_SESSION['feultses']) ? "Su ultima conexion fue el ".$_SESSION['feultses'] : "Este es su primer Ingreso";
				$this->session->set_flashdata("mensaje_exito","Bienvenido al sistema ".$msg_ultconex);
				$_SESSION['is_logged_in']=true;
				//redirect(base_url().'index.php/home');
				$_SESSION['usad']=true;							
				$this->home();
			} else { 
				$this->session->set_flashdata("mensaje_error","Contraseña Invalida");
				redirect(base_url().'index.php/adm');
			}                     
        }
	}




	public function signin()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'required|min_length[5]|max_length[12]');
		 if ($this->form_validation->run() == FALSE)
        {
                $this->login();//load->view('login');
        }
        else
        {
			$correo = $this->input->post('email');
			$pass = $this->input->post('pass');
			$user = $this->Usuario_model->getUsuarioxEmail($correo);
			
			if (!$user) {
				$this->session->set_flashdata("mensaje_error","Usuario Invalido".$user->us_nombre_a.$correo);
				redirect(base_url().'index.php/login');
			}
			//aqui valido la clave de usuario
			if ($user->uv_clave_a == md5($pass)) {
				$_SESSION['useid']= $user->uv_us_verumcard_a_pk;
				$_SESSION['user_name']= $user->uv_nombre_a;	
				$this->Autenticacion_model->crearSesion($_SESSION['useid']);
				$_SESSION['feultses']=$this->Autenticacion_model->getUltimaSesion($_SESSION['useid']);
				$msg_ultconex=($_SESSION['feultses']) ? "Su ultima conexion fue el ".$_SESSION['feultses'] : "Este es su primer Ingreso";
				$this->session->set_flashdata("mensaje_exito","Bienvenido al sistema. ".$msg_ultconex);
				$_SESSION['is_logged_in']=true;
				$_SESSION['usad']=false;
				redirect(base_url().'index.php/home');							
			} else { 
				$this->session->set_flashdata("mensaje_error","Contraseña Invalida");
				redirect(base_url().'index.php/login');
			}                     
        }
	}	

	public function home() {
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->contenido = "welcome_message";
		$data->panel_title = "Pagina Principal";
		//$data->isadmin = $isadmin;
		$data->active = "home";
		$this->load->view('home',$data);
	}
	
	public function logout() {
		$this->Autenticacion_model->cerrarSesion($_SESSION['sess']);
		session_destroy();
		redirect();						
			
	}
	public function logoutAdministrador() {
		$this->Autenticacion_model->cerrarSesionAdmin($_SESSION['sess']);
		session_destroy();
		redirect(base_url().'index.php/adm');					
			
	}
}
?>

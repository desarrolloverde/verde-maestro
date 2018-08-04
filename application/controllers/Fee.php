<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Fee extends CI_Controller {
	public function  __construct() {

		parent::__construct();
		if ($_SESSION["sess"]=='') {
			redirect(base_url().'index.php');
		}
		if ($_SESSION['usad']!=true) {
			redirect(base_url().'index.php');
		}
		$this->load->model('Fee_model');
		//$this->load->model('Administrador_model');
	}
	/**
	*Display de registro de FEe
	*/
	public function registroDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Registro de Fee (Tasa, Comision)";
		$data->isadmin = true;
		$data->contenido = "fee/registro"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de registro de usuario
	*/
	public function listadoDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Listado de Fee usados <br>en Sistema";
		$data->isadmin = true;
		$data->datos = $this->Fee_model->getFee();
		$data->contenido = "fee/fees"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de Modificacion
	*/
	public function editarDisplay($id)
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Editar Fee";
		$data->isadmin = true;
		$data->datos = $this->Fee_model->getFee($id);
		$data->contenido = "fee/registro"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Controlador para registro de Moneda
	*/
	public function insertarFee(){
		$this->form_validation->set_rules('porcentaje', 'porcentaje', 'required|min_length[1]|max_length[3]|numeric');
		$this->form_validation->set_rules('descripcion', 'descripcion', 'required|min_length[10]|max_length[15]');
		$this->form_validation->set_rules('status', 'status', 'required');
		//mensaje para validaciones
		$this->form_validation->set_message('required', 'El %s es requerido');
		$this->form_validation->set_message('required', 'El %s debe ser numero');
        $this->form_validation->set_message('min_length', 'El %s debe tener al menos mas de %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s debe tener menos de %s carácteres');
		if ($this->form_validation->run() == FALSE)
        {
                $this->registroDisplay();//load->view('login');
        }
        else
        {
        	//if (isset($this->input->post)) {
	        	$porcentaje  = $this->input->post('porcentaje'); 
	        	$descripcion= $this->input->post('descripcion');
	        	//$status= $this->input->post('status');
	        	$ejecucion=$this->Fee_model->insertarFee($porcentaje,$descripcion,$_SESSION['sess']);
	        	if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","La moneda $descripcion ha sido ingresado");
			        redirect(base_url().'index.php/fee');
		    	}
	        	
	        //}

        }

	}
		/**
	*Display de Modificacion
	*/
	public function editarFee($id)
	{
		$this->form_validation->set_rules('porcentaje', 'porcentaje', 'required|min_length[1]|max_length[6]|numeric');
		$this->form_validation->set_rules('descripcion', 'descripcion', 'required|min_length[5]|max_length[20]');
		$this->form_validation->set_rules('status', 'status', 'required');
		//mensaje para validaciones
		$this->form_validation->set_message('required', 'El %s es requerido');
		$this->form_validation->set_message('required', 'El %s debe ser numero');
        $this->form_validation->set_message('min_length', 'El %s debe tener al menos mas de %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s debe tener menos de %s carácteres');
		if ($this->form_validation->run() == FALSE)
        {
                $this->editarDisplay($id);//load->view('login');
        } else {
			if($id != NULL) {
				$id  = $this->input->post('id'); 
				$prefijo  = $this->input->post('porcentaje'); 
	        	$descripcion= $this->input->post('descripcion');
	        	$status= $this->input->post('status');
	        	$ejecucion=$this->Fee_model->editarFee($id,$prefijo,$descripcion,$status);
	        	if ($ejecucion) { 
			        	 $this->session->set_flashdata("mensaje_exito","Modificacion Exitosa");
				        redirect(base_url().'index.php/fee');
			    }
			} else {
				$this->listadoDisplay();	
			}
		}


	}

	//funcion para Eliminacion logica de Fee 
	public function borrarFee($id = NULL)
	{
		if($id != NULL) {
			$ejecucion=$this->Fee_model->eliminarFee($id);
			if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","Eliminacion Exitosa");
			        redirect(base_url().'index.php/fee');
		    }
		}


	}
	
}




?>
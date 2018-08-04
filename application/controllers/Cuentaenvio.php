<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Cuentaenvio extends CI_Controller {
	public function  __construct() {

		parent::__construct();
		if ($_SESSION["sess"]=='') {
			redirect(base_url().'index.php');
		}
		$this->load->model('Cuentaenvio_model');
		$this->load->model('Banco_model');
	}
	/**
	*Display de registro de Cuentas de envio
	*/
	public function registroDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Registro Cuentas de Envio de GiftCard";
		//$data->isadmin = false;
		$data->datossel = $this->Banco_model->getBancos();
		$data->contenido = "cuentaenvio/registro"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de registro de usuario
	*/
	public function listadoDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Registro de Cuentas de Envio de GiftCard";
		//$data->isadmin = true;
		$data->datos = $this->Cuentaenvio_model->getCuentaenvio();
		$data->contenido = "cuentaenvio/cuentasenvio"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de Modificacion
	*/
	public function editarDisplay($id)
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Editar Cuentas de Envio de GiftCard";
		//$data->isadmin = true;
		$data->datos = $this->Cuentaenvio_model->getCuentaenvio($id);
		$data->datossel = $this->Banco_model->getBancos();
		$data->contenido = "cuentaenvio/registro"; //archivo en view
		$this->load->view('home',$data);
	}

	/**
	*Controlador para registro de Banco
	$nombre,$apellido,$clave,$email,$nurol
	*/
	public function insertarCuentaenvio(){
		$this->form_validation->set_rules('nucuenta', 'numero de cuenta', 'required|min_length[20]|max_length[20]');
		$this->form_validation->set_rules('idnac', 'idnac', 'required|min_length[1]|max_length[1]');
		$this->form_validation->set_rules('cititular', 'cititular', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('nbtitular', 'nbtitular', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('email', 'email', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('idbanco', 'idbanco', 'required');
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
        		$nucuenta=$this->input->post('nucuenta');;
        		$prefnac=$this->input->post('idnac');
        		$cedulatit=$this->input->post('cititular');
        		$nbtit=$this->input->post('nbtitular');
        		$emailtit=$this->input->post('email');
        		$idbanco=$this->input->post('idbanco');
	        	$idusuario=$_SESSION['useid'];
	        	$ejecucion=$this->Cuentaenvio_model->insertarCuentaenvio($nucuenta,$idusuario,$prefnac,$cedulatit,$nbtit,$emailtit,$idbanco);
	        	if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","El Cuentaenvio  ha sido ingresado");
			        redirect(base_url().'index.php/cuentaenvio');
		    	}
	        	
	        //}

        }

	}

	//funcion para borrar banco........ la eliminacion debe ser logica
	public function borrarCuentaenvio($id = NULL)
	{
		if($id != NULL) {
			$ejecucion=$this->Cuentaenvio_model->eliminarCuentaenvio($id);
			if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","Eliminacion Exitosa");
			        redirect(base_url().'index.php/cuentaenvio');
		    }
		}


	}

	/**
	*Display de Modificacion
	*/
	public function editarCuentaenvio($id = NULL)
	{
		$this->form_validation->set_rules('nucuenta', 'numero de cuenta', 'required|min_length[20]|max_length[20]');
		$this->form_validation->set_rules('idnac', 'idnac', 'required|min_length[1]|max_length[1]');
		$this->form_validation->set_rules('cititular', 'cititular', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('nbtitular', 'nbtitular', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('email', 'email', 'required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('idbanco', 'idbanco', 'required');
		//mensaje para validaciones
		$this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('min_length', 'El %s debe tener al menos mas de %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s debe tener menos de %s carácteres');
		if ($this->form_validation->run() == FALSE)
        {
                $this->editarDisplay($id);//load->view('login');
        } else {
			if($id != NULL) {
				$nucuenta=$this->input->post('nucuenta');;
        		$prefnac=$this->input->post('idnac');
        		$cedulatit=$this->input->post('cititular');
        		$nbtit=$this->input->post('nbtitular');
        		$emailtit=$this->input->post('email');
        		$idbanco=$this->input->post('idbanco');
	        	$id=$this->input->post('id');
				$ejecucion=$this->Cuentaenvio_model->editarCuentaenvio($id,$nucuenta,$prefnac,$cedulatit,$nbtit,$emailtit,$idbanco);
				if ($ejecucion) { 
			        	 $this->session->set_flashdata("mensaje_exito","Modificacion Exitosa");
				        redirect(base_url().'index.php/cuentaenvio');
			    }
			} else {
				$this->listadoDisplay();	
			}
		}


	}
	
}




?>
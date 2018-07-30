<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Giftcardadm extends CI_Controller {
	public function  __construct() {

		parent::__construct();
		if ($_SESSION["sess"]=='') {
			redirect(base_url().'index.php');
		}
		$this->load->model('Giftcardadm_model');
		//$this->load->library('image_lib');
		//$this->load->model('Administrador_model');
	}
	/**
	*Display de registro de giftcard
	*/
	public function registroDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Registro de servicios Giftcard";
		$data->isadmin = true;
		$data->contenido = "giftcardadm/registro"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de registro de usuario
	*/
	public function listadoDisplay()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->panel_title = "Administración de servicio de Tarjetas Giftcard";
		$data->isadmin = true;
		$data->datos = $this->Giftcardadm_model->getGiftcardadm();
		$data->contenido = "giftcardadm/giftcardsadm"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de Modificacion
	*/
	public function editarDisplay($id)
	{
		$data = new stdClass();
		$data->title = "VerumCard Web Page";
		$data->panel_title = "Editar de servicios Giftcard";
		$data->isadmin = true;
		$data->datos = $this->Giftcardadm_model->getGiftcardadm($id);
		$data->contenido = "giftcardadm/registro"; //archivo en view
		$this->load->view('home',$data);
	}

	/**
	*Controlador para registro de Banco
	*/
	public function insertarGiftcardadm(){
		$this->form_validation->set_rules('valor', 'valor', 'required|min_length[2]|max_length[3]');
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
        //print_r($_FILES['imagen']);
        	//if (isset($this->input->post)) {
	        	$valor  = $this->input->post('valor'); 
	        	$ejecucion=$this->Giftcardadm_model->insertarGiftcardadm($valor,'07',$_SESSION['sess']);
	        	if ($ejecucion) {	        		
	        		$valor  = $this->input->post('valor');
	        		$imagen  = 'imagen';//$this->input->post('imagen');
	        		$maxid=$this->Giftcardadm_model->getMaxidgc();
	        	 	$this->cargarGiftcardImagen($maxid[0]->maxid,$valor); ////debo validar que se cargue el archivo
		        	$this->session->set_flashdata("mensaje_exito","La Giftcard de $valor $ ha sido ingresada");
			        redirect(base_url().'index.php/giftcardadm');
		    	}
	        	
	        //}

        }

	}

	//funcion para borrar ........ la eliminacion debe ser logica
	public function borrarGiftcardadm($id)
	{
		if($id != NULL) {
			$ejecucion=$this->Giftcardadm_model->eliminarGiftcardadm($id);
			if ($ejecucion) { 
		        	 $this->session->set_flashdata("mensaje_exito","Eliminacion Exitosa");
			        redirect(base_url().'index.php/giftcardadm');
		    } 
		}


	}

	/**
	*Display de Modificacion
	*/
	public function editarGiftcardadm($id = NULL)
	{
		$this->form_validation->set_rules('valor', 'valor', 'required|min_length[2]|max_length[3]');
		//mensaje para validaciones
		$this->form_validation->set_message('required', 'La %s es requerido');
        $this->form_validation->set_message('min_length', 'La %s debe tener al menos mas de %s carácteres');
        $this->form_validation->set_message('max_length', 'La %s debe tener menos de %s carácteres');
		if ($this->form_validation->run() == FALSE)
        {
                $this->editarDisplay($id);//load->view('login');
        } else {
			if($id != NULL) {
				$valor  = $this->input->post('valor');
				$ejecucion=$this->Giftcardadm_model->editarGiftcardadm($id,$valor,'07',$_SESSION['sess']);
				if ($ejecucion) { 
						$this->cambiarGiftcardImagen($id, $valor); //igual validar almacenamiento
			        	 $this->session->set_flashdata("mensaje_exito","Modificacion Exitosa");
				        redirect(base_url().'index.php/giftcardadm');
			    }
			} else {
				$this->listadoDisplay();	
			}
		}


	}

	public function cargarGiftcardImagen($id,$valor) {


	    //$mi_imagen = $archivo;//$archivo['tmp_name'];//'mi_imagen';
	    $config['upload_path'] = "./assets/img/uploads";
	    $config['file_name'] = $id.'-'.$valor ;
	    $config['allowed_types'] = "gif|jpg|jpeg|png";
	    $config['overwrite'] = TRUE;
	    $config['max_size'] = "50000";
	    $config['max_width'] = "2000";
	    $config['max_height'] = "2000";

	    $this->load->library('upload', $config);

	    if (!$this->upload->do_upload('imagen')) {
	        //*** ocurrio un error
	        $data['uploadError'] = $this->upload->display_errors();
	        echo $this->upload->display_errors();
	        return;
	    }

	    $data['uploadSuccess'] = $this->upload->data();
	    //print_r($data);
	    $rutaimg='assets/img/uploads/'.$data['uploadSuccess']['file_name'];
	    $this->Giftcardadm_model->insertarGiftcardadmImg($id,$rutaimg,$_SESSION['sess']);
    }

    public function cambiarGiftcardImagen($id,$valor) {


	    
	    $config['upload_path'] = "./assets/img/uploads";
	    $config['file_name'] = $id.'-'.$valor ;
	    $config['allowed_types'] = "gif|jpg|jpeg|png";
	    $config['overwrite'] = TRUE;
	    $config['max_size'] = "50000";
	    $config['max_width'] = "2000";
	    $config['max_height'] = "2000";

	    $this->load->library('upload', $config);

	    if (!$this->upload->do_upload('imagen')) {
	        //*** ocurrio un error
	        $data['uploadError'] = $this->upload->display_errors();
	        echo $this->upload->display_errors();
	        return;
	    }

	    $data['uploadSuccess'] = $this->upload->data();
	    //print_r($data);
	    $rutaimg='assets/img/uploads/'.$data['uploadSuccess']['file_name'];
	    $this->Giftcardadm_model->cambiarGiftcardadmImg($id,$rutaimg,$_SESSION['sess']);
    }

    /*
    if ($data['file_ext'] == ".jpg" || $data['file_ext'] == ".png" || $data['file_ext'] == ".jpeg" || $data['file_ext'] == ".gif") {
	$this->foto_redimencionar($data['full_path'], $data['file_name'], $dir);
	}

	Finalmente, el método para reescalar la imagen:

	private function foto_redimencionar($ruta, $nombre, $dir) {
		$config['image_library'] = 'gd2';
		$config['source_image'] = $ruta;
		$config['new_image'] = $dir . '/' . $nombre;
		$config['maintain_ratio'] = TRUE;
		$config['height'] = 300;

		$this->load->library('image_lib', $config);

		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}
	}


    */


	
}




?>
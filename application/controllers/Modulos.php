<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Modulos extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *Pagina de prueba
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Modulos_model');
	}

	public function modulos_display() {
		$data = new stdClass();
		$data->modulos = $this->Modulos_model->getmodulos();
		$data->title = "Aplicacion de Pruebas";
		$data->contenido = "administracion/modulos";
		$data->panel_title = "Listado de Modulos";
		$data->active = "Modulos";
		$this->load->view('home',$data);
	}
}


?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *Pagina de prueba
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		}	
	public function index()
	{
		$data = new stdClass();
		$data->title = "VerumCard";
		$data->contenido = "home/index";
		//$data->contenido2 = "index/home";
		//$data->contenido3 = "index/home";
		$this->load->view('index',$data); 
	}
	public function hola() 
	{
		$this->load->view('test'); //echo "This is hello function.";
	}
}
?>

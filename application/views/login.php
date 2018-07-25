<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('plantillas/frontend/head'); 
$this->load->view('plantillas/frontend/header_login');
$this->load->view($contenido);
$this->load->view('plantillas/frontend/footer');


?>

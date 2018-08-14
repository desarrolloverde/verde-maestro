<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('plantillas/frontend/head'); 
$this->load->view('plantillas/frontend/header_login');
$this->load->view($contenido);
if (isset($contenido2)) { $this->load->view($contenido2); }
if (isset($contenido3)) { $this->load->view($contenido3); }
$this->load->view('plantillas/frontend/footer');


?>

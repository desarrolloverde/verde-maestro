<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('plantillas/frontend/head');
if ($_SESSION['usad']==true) {
	$this->load->view('plantillas/frontend/header_adm');
} else {
	$this->load->view('plantillas/frontend/header');
}
$this->load->view($contenido);
$this->load->view('plantillas/frontend/footer');

?>
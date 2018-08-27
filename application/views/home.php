<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ($_SESSION["sess"]=='') {
			redirect(base_url().'index.php');
} /*else {
	redirect(base_url().'index.php/logout');
}*/

$this->load->view('plantillas/frontend/head');
if ($_SESSION['usad']==true) {
	$this->load->view('plantillas/frontend/header_adm');
} else {
	$this->load->view('plantillas/frontend/header');
}
$this->load->view($contenido);
$this->load->view('plantillas/frontend/footer');

?>
<?php
defined('BASEPATH') OR exit('Acceso directo no permitido');

class Transacciongift extends CI_Controller {
	public function  __construct() {

		parent::__construct();
		if ($_SESSION["sess"]=='') {
			redirect(base_url().'index.php');
		}
		$this->load->model('Giftcardadm_model');
		$this->load->model('Moneda_model');
		$this->load->model('Tasa_model');
		$this->load->model('Fee_model');
		$this->load->model('Cuentaenvio_model');
		$this->load->model('Cuentapago_model');
		$this->load->model('Franquicia_model');
		$this->load->model('Transacciongc_model');

	}
	/**
	*Display de registro de Transacciones
	*/
	public function listadoDisplay()
	{ 
		$data = new stdClass();
		//echo "hola".$this->input->post('registrogc');
		$data->title = "VerumCard";
		$data->panel_title = "Listado Transacciones Realizadas";
		$data->target="transacciongift/registroDisplay";
		$data->datos = $this->Transacciongc_model->getTransacciongcxUsuario($_SESSION['useid']);
		if (count($data->datos)==0) {
			redirect(base_url().'index.php/transacciongift/registroDisplay');
		}
		$data->contenido = "transacciongift/transaccionesgift"; //archivo en view
		$this->load->view('home',$data);
	}
	/**
	*Display de registro de Transacciones
	*/
	public function registroDisplay()
	{ 
		$data = new stdClass();
		//echo "hola".$this->input->post('registrogc');
		$data->title = "VerumCard";
		$data->panel_title = "Montos de tarjetas disponibles";
		$data->panel_title1 = "Calculo de monto total a depositar";
		$data->target='transacciongift/registroDisplay';
		$data->datosgc = $this->Giftcardadm_model->getGiftcardadm();
		$data->montotasa = $this->Tasa_model->getTasaxMonedaActiva(1); //envio por defecto tipo moneda 1 que es $
		$data->porcfee = $this->Fee_model->getFeeActivo();
		$data->listctas = $this->Cuentaenvio_model->getCuentaenvioxUsuario($_SESSION['useid']);

		//Evalua si pulso el boton confirmar
		if ($this->input->post('registrogc')!="") {
				$this->form_validation->set_rules('montogc', 'Tarjeta Giftcard', 'required','numeric');
				$this->form_validation->set_rules('ctaenvio', 'Cuenta Bancaria', 'required');
				$this->form_validation->set_message('required', 'Seleccione la %s ');
				
				//$this->form_validation->run();
				if ($this->form_validation->run() != FALSE)
				{
					$this->confirmacionTrans();//load->view('login');
				} else { 
					if ($this->input->post('idgc')) {
						$data->idgc=$this->input->post('idgc');
						$giftcard=$this->Giftcardadm_model->getGiftcardadm($this->input->post('idgc'));
				$data->gcselect= $giftcard[0]->ruta;//$this->input->post('gcselect'); 
					}
					$data->contenido = "transacciongift/transacciongift"; //archivo en view
					$this->load->view('home',$data);
				}
	    } else { 

			//Aqui valido las acciones del usuario
			if ($this->input->post('idgc')) {
				$data->idgc=$this->input->post('idgc');
				$giftcard=$this->Giftcardadm_model->getGiftcardadm($this->input->post('idgc'));
				$data->gcselect= $giftcard[0]->ruta;//$this->input->post('gcselect');
				$data->montogc = $giftcard[0]->gf_valor_i;//$this->input->post('montogc');
				$totalcambiario = $giftcard[0]->gf_valor_i * $this->Tasa_model->getTasaxMonedaActiva(1);
				$data->montofee = ($totalcambiario/100) * $this->Fee_model->getFeeActivo();
				$data->montotot = $totalcambiario - $data->montofee;
			}      

			$data->contenido = "transacciongift/transacciongift"; //archivo en view
			$this->load->view('home',$data);
		}
	}
	
	/**
	*Controlador para confirmacion de transacciones
	*/
	public function confirmacionTrans(){
			
        $data = new stdClass();
		//echo "hola".$this->input->post('registrogc');
		$data->title = "VerumCard";
		$data->panel_title = "Datos de Transaccion";
		$data->panel_title1 = "Datos de Tarjeta ";
		$data->target='transacciongift/insertarTrans';
		$data->datosgc = $this->Giftcardadm_model->getGiftcardadm($this->input->post('idgc'));
		$data->datoscuenta = $this->Cuentaenvio_model->getCuentaenvio($this->input->post('ctaenvio'));
		$data->listfranquicia = $this->Franquicia_model->getFranquicia();
    	$data->direccion=$this->input->post('direccion');
    	$data->vencimiento=$this->input->post('vencimiento');
		$data->montotot=$this->input->post('montotot');
		$data->contenido = "transacciongift/confirmaciongift"; //archivo en view
		$this->load->view('home',$data);
		

		//$data->montotasa = $this->Tasa_model->getTasaxMonedaActiva(1); //envio por defecto tipo moneda 1 que es $
		//$data->porcfee = $this->Fee_model->getFeeActivo();
		//$data->listctas = $this->Cuentaenvio_model->getCuentaenvioxUsuario($_SESSION['useid']);

	}	

	/**
	*Controlador para registro de transacciones
	*/
	public function insertarTrans() {
		
		$this->form_validation->set_rules('nutarjeta', 'Numero de Tarjeta', 'required|max_length[18]','numeric');
		$this->form_validation->set_rules('nombretarjeta', 'Nombre en tarjeta', 'required|min_length[10]|max_length[20]');
		$this->form_validation->set_rules('vencimiento', 'Fecha de vencimiento', 'required');
		$this->form_validation->set_rules('cvv', 'Numero de seguridad de tarjeta', 'required|max_length[3]','numeric');
		$this->form_validation->set_rules('direccion', 'Direccion de negocios', 'required|min_length[18]|max_length[50]');
		
		//mensaje para validaciones
		$this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('min_length', 'El  %s debe tener al menos mas de %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s debe tener menos de %s carácteres');
        $this->form_validation->set_message('numeric', 'El %s debe ser solo numeros');
		if ($this->form_validation->run() == FALSE)
        {
            $this->confirmacionTrans();//load->view('login');
        } else {
        	//aqui realiza la insercion
        	//////###Paso 1 Registro de cuenta Pago
        	$nutarjeta=$this->input->post('nutarjeta');
        	$nomape=$this->input->post('nombretarjeta');
        	$idtarjeta=$this->input->post('tpfranquicia');
        	$vencimiento=$this->input->post('vencimiento');
        	$cvv=$this->input->post('cvv');
        	$direccion=$this->input->post('direccion');
        	$sesion=$_SESSION['sess'];

        	$result1=$this->Cuentapago_model->insertarCuentapago($nutarjeta,$idtarjeta,$nomape,$vencimiento,$cvv,$direccion,$sesion);

        	/////###Paso 2 Registro de Transaccion Giftcard	
        	$idgc=$this->input->post('idgc');
        	$ctaenvio=$this->input->post('ctaenvio');
        	$porcfee=$this->Fee_model->getFeeActivo();
        	$giftcard=$this->Giftcardadm_model->getGiftcardadm($idgc);
        	$montofee=$this->calculoFee($giftcard[0]->gf_valor_i);
        	$montotot=$this->montoTotal($giftcard[0]->gf_valor_i);
        	$nuctaenvio=$this->input->post('ctaenvio');
        	$idtarjeta=$this->Cuentapago_model->getIDCuentaPagoxsesion($nutarjeta,$_SESSION['sess']);
        	$montotasa=$this->Tasa_model->getTasaxMonedaActiva(1);
        	$tasa=$this->Tasa_model->getTasasxMoneda(1);
        	$idtasa=$tasa[0]->ts_id_tasa_a_pk;
     		if ($result1) {
        		$result2 = $this->Transacciongc_model->insertarTransacciongc($porcfee,$nutarjeta,$montofee,$montotot,$nuctaenvio,$idtarjeta,$montotasa,$idtasa);
			} else { log_message('error', 'Fallo insercion de trasnsaccion paso 1.'); }
        	/////###Paso 3 Ingreso de tablas relacionales
			$idtransgc=$this->Transacciongc_model->getIDTransgcxsesion($nutarjeta,$_SESSION['sess']);
        	if ($result2) {
                    $result3=$this->Transacciongc_model->insertarTransacciongcRelacion($idtransgc,$idgc,$giftcard[0]->gf_valor_i);

                } else { log_message('error', 'Fallo insercion de trasnsaccion paso 2.'); }

			if ($result3) {
				$this->session->set_flashdata("mensaje_exito","La Transaccion ha sido Completada");
			     redirect(base_url().'index.php/giftcard');

			} else { }




        	

        }

	}



	public function calculoFee($montogf) {
				$totalcambiario = $montogf * $this->Tasa_model->getTasaxMonedaActiva(1);
				return ($totalcambiario/100) * $this->Fee_model->getFeeActivo();

	}

	public function montoTotal($montogf) {
		return $totalcambiario = ($montogf * $this->Tasa_model->getTasaxMonedaActiva(1)) - $this->calculoFee($montogf);
	}
}


?>
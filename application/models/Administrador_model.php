<?php
/**
*Clase de manejo de usuarios administradores
*
*/
class Administrador_model extends CI_Model {

        private  $clstabla='vc_m_us_administrativos';
        private  $tbl_idpk='us_id_usuario_a_pk';
        private  $tbl_clave='us_clave_a';
        private  $tbl_nombrea='us_nombre_a';
        private  $tbl_id='us_id_a_pk';
        private  $tbl_apellidoa='us_apellido_a';
        private  $tbl_email='us_email_a';
        private  $tbl_status='us_estatus_b';
        private  $tbl_feregistro='us_fe_registro_t';

        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database(); //no es necesario por el autoload
        }

        public function getUsuario($id = FALSE)
        {
                if ($id === FALSE) {                                        
                        $query = $this->db->get($this->clstabla);
                        return $query->result();
                }                
                
                $query = $this->db->get_where($this->clstabla,array($this->tbl_idpk=>$id));
                
                return $query->result();//result_array();
        }



        public function insertarUsuario($password,$nombres,$apellidos,$ida,$email)
        {
                $maxid=$this->maxid();
                $tabla = array (
                	//'uv_us_verumcard_a_pk'=>$maxid+1, ya configurada sequencia
                	$this->tbl_clave=>md5($password),
                	$this->tbl_nombrea=>$nombres,
                    $this->tbl_id=>$ida,
                	$this->tbl_apellidoa=>$apellidos,
                	$this->tbl_email=>$email,
                	$this->tbl_status=>TRUE,
                	$this->tbl_feregistro=>date("d/m/Y H:i:s")
                	);         
                
                $result = $this->db->insert($this->clstabla,$tabla);
                return $result;
        }

        public function getUsuarioxEmail($email)
        {
               $query = $this->db->get_where($this->clstabla,array($this->tbl_email=>$email));
               return $query->row();
        }


}
?>

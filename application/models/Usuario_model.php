<?php
/**
*Clase de manejo de usuarios del sistema
*
*/
class Usuario_model extends CI_Model {
        private  $idusuario;
        private  $clave;
        private  $nombrea;
        private  $apellidoa;
        private  $email;
        private  $fenacimiento;
        private  $status;
        private  $feregistro;

        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database(); //no es necesario por el autoload
        }

        public function getUsuario($id = FALSE)
        {
                if ($id === FALSE) {                                        
                        $query = $this->db->get('vc_m_usuario_verumcard');
                        return $query->result();
                }                
                
                $query = $this->db->get_where('vc_m_usuario_verumcard',array('uv_us_verumcard_a_pk'=>$id));
                
                return $query->result();//result_array();
        }

        

        public function insertarUsuario($password,$nombres,$apellidos,$email,$fenacimiento)
        {
                //$maxid=$this->maxid();
                $tabla = array (
                	//'uv_us_verumcard_a_pk'=>$maxid+1, ya configurada sequencia
                	'uv_clave_a'=>md5($password),
                	'uv_nombre_a'=>$nombres,
                	'uv_apellido_a'=>$apellidos,
                	'uv_email_a'=>$email,
                	'uv_fecha_nacimiento_d'=>$fenacimiento,
                	'uv_estatus_b'=>TRUE,
                	'uv_fe_registro_t'=>date("d/m/Y H:i:s")
                	);         
                
                $result = $this->db->insert('vc_m_usuario_verumcard',$tabla);
                return $result;//result_array();
                //$sql = $this->db->set($tabla)->get_compiled_insert('verumweb.vc_m_usuario_verumcard');
				//return $sql;
        }

        public function getUsuarioxEmail($email)
        {
               $this->db->where('uv_email_a',$email);                
               $query = $this->db->get('vc_m_usuario_verumcard');
               return $query->row();
        }


}
?>

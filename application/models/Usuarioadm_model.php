<?php
/**
*Clase de manejo de usuarios administradores
*
us_id_usuario_a_pk, us_clave_a, us_nombre_a, us_id_a_pk, us_apellido_a, 
       us_email_a, us_estatus_b, us_fe_registro_t
*/
class Usuarioadm_model extends CI_Model {

        private  $clstabla='vc_m_us_administrativos';
        private  $tbl_idpk='us_id_usuario_a_pk';
        private  $tbl_clave='us_clave_a';
        private  $tbl_nombre='us_nombre_a';
        private  $tbl_rol='us_id_a_pk';
        private  $tbl_apellido='us_apellido_a';
        private  $tbl_email='us_email_a';
        private  $tbl_estatus='us_estatus_b';
        private  $tbl_feregistro='us_fe_registro_t';


        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database(); //no es necesario por el autoload
        }
        /*
        *   RETORNA LISTA DE USUARIOS ADMINISTRADORES CON CUALQUIER ROL
        *
        *
        */
        public function getUsuarioadm($id = FALSE)
        {
                if ($id === FALSE) {                                        
                    //$query = $this->db->get($this->clstabla);
                    $query = $this->db->query("SELECT us_id_usuario_a_pk, us_clave_a, us_nombre_a,
                     us_id_a_pk, us_apellido_a, us_email_a, us_estatus_b, us_fe_registro_t, B.rl_descripcion_a
                      AS rol FROM vc_m_us_administrativos A INNER JOIN vc_m_roles B on 
                      A.us_id_a_pk = B.rl_id_rol_a_pk WHERE us_estatus_b = TRUE");
                    return $query->result();
                } else {
                    $query = $this->db->query("SELECT us_id_usuario_a_pk, us_clave_a, us_nombre_a,
                     us_id_a_pk, us_apellido_a, us_email_a, us_estatus_b, us_fe_registro_t, B.rl_descripcion_a
                      AS rol FROM vc_m_us_administrativos A INNER JOIN vc_m_roles B on 
                      A.us_id_a_pk = B.rl_id_rol_a_pk WHERE us_estatus_b = TRUE AND us_id_usuario_a_pk='".$id."'");
                    return $query->result();
                }               
        }

        /*
        *       RETORNA LISTA DE USUARIOS ADMINISTRADORES X ROL
        *
        */
        
        public function getUsuarioadmxRol($rol)
        { 
                    $query = $this->db->query("SELECT us_id_usuario_a_pk, us_clave_a, us_nombre_a,
                     us_id_a_pk, us_apellido_a, us_email_a, us_estatus_b, us_fe_registro_t, B.rl_descripcion_a
                      AS rol FROM vc_m_us_administrativos A INNER JOIN vc_m_roles B on 
                      A.us_id_a_pk = B.rl_id_rol_a_pk WHERE us_estatus_b = TRUE AND us_id_a_pk='".$rol."'");           
                    return $query->result();
                
        }

        public function insertarUsuarioadm($nombre,$apellido,$clave,$email,$nurol)
        {
                $tabla = array (
                	$this->tbl_nombre=>$nombre,
                	$this->tbl_apellido=>$apellido,
                    $this->tbl_clave=>md5($clave),
                    $this->tbl_email=>$email,
                    $this->tbl_rol=>$nurol,
                    $this->tbl_estatus=>TRUE,
                	$this->tbl_feregistro=>date("d/m/Y H:i:s")
                	);         
                
                $result = $this->db->insert($this->clstabla,$tabla);
                return $result;
        }

        public function eliminarUsuarioadm($id)
        {
               $result = $this->db->update($this->clstabla,array($this->tbl_estatus => FALSE ),array($this->tbl_idpk=>$id));
               return $result;
        }

        public function editarUsuarioadm($id,$nombre,$apellido,$clave,$email,$nurol)
        {
                $tabla = array (
                    $this->tbl_nombre=>$nombre,
                    $this->tbl_apellido=>$apellido,
                    $this->tbl_clave=>md5($clave),
                    $this->tbl_email=>$email,
                    $this->tbl_rol=>$nurol,
                    $this->tbl_estatus=>TRUE,
                    $this->tbl_feregistro=>date("d/m/Y H:i:s")
                    );                
                $result = $this->db->update($this->clstabla,$tabla,array($this->tbl_idpk => $id));
                return $result;
        }

        public function getRoles()
        {
            $this->db->select('rl_id_rol_a_pk,rl_descripcion_a');
            $query = $this->db->get('vc_m_roles');
            return $query->result();
        }




}
?>

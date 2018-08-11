<?php
/**
*Clase de manejo de usuarios administradores
*
vc_m_bancos(
            bc_id_banco_a_pk, bc_entidad_bancaria_a, bc_estatus_b, bc_id_sesion_a, 
            bc_fe_registro_t
*/
class Banco_model extends CI_Model {

        private  $clstabla='vc_m_bancos';
        private  $tbl_idpk='bc_id_banco_a_pk';
        private  $tbl_entidad='bc_entidad_bancaria_a';
        private  $tbl_estatus='bc_estatus_b';
        private  $tbl_sesion='bc_id_sesion_a';
        private  $tbl_feregistro='bc_fe_registro_t';
        private  $tbl_coentidad='bc_co_entidad_a';


        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database(); //no es necesario por el autoload
        }

        public function getBancos($id = FALSE)
        {
                if ($id === FALSE) {                                        
                        $query = $this->db->get_where($this->clstabla,array($this->tbl_estatus=>TRUE));
                        return $query->result();
                }                
                
                $query = $this->db->get_where($this->clstabla,array($this->tbl_idpk=>$id,$this->tbl_estatus=>TRUE));
                
                return $query->result();//result_array();
        }



        public function insertarBanco($nbentidad,$sesion,$coentidad)
        {
                $tabla = array (
                	$this->tbl_entidad=>$nbentidad,
                	$this->tbl_estatus=>TRUE,
                    $this->tbl_sesion=>$sesion,
                	$this->tbl_feregistro=>date("d/m/Y H:i:s"),
                	$this->tbl_coentidad=>$coentidad      	
                	);         
                
                $result = $this->db->insert($this->clstabla,$tabla);
                return $result;
        }

        public function eliminarBanco($idbanco)
        {
               $result = $this->db->update($this->clstabla,array($this->tbl_estatus=>FALSE),array($this->tbl_idpk=>$idbanco));
               return $result;
        }

        public function editarBanco($id,$nbentidad,$coentidad)
        {
                $tabla = array (
                    $this->tbl_entidad=>$nbentidad,
                    $this->tbl_sesion=>$_SESSION['sess'],
                    $this->tbl_feregistro=>date("d/m/Y H:i:s"),
                    $this->tbl_coentidad=>$coentidad        
                    );         
                $result = $this->db->update($this->clstabla,$tabla,array($this->tbl_idpk => $id));
                return $result;
        }




}
?>

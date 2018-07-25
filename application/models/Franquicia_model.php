<?php
/**
*Clase de manejo de usuarios administradores
*
*/
class Franquicia_model extends CI_Model {

        private  $clstabla='vc_m_franquicia';
        private  $tbl_idpk='tt_id_tarjeta_pk';
        private  $tbl_descripcion='tt_descripcion_a';
        private  $tbl_estatus='tt_estatus_b';
        private  $tbl_sesion='tt_id_sesion_a';
        private  $tbl_feregistro='tt_fe_registro_t';
        private  $tbl_coentidad='bc_co_entidad_a';


        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database(); //no es necesario por el autoload
        }

        public function getFranquicia($id = FALSE)
        {
                if ($id === FALSE) {                                        
                        $query = $this->db->get($this->clstabla);
                        return $query->result();
                }                
                
                $query = $this->db->get_where($this->clstabla,array($this->tbl_idpk=>$id));
                
                return $query->result();//result_array();
        }



        public function insertarFranquicia($descripcion,$sesion)
        {
                $tabla = array (
                	$this->tbl_descripcion=>$descripcion,
                	$this->tbl_estatus=>TRUE,
                    $this->tbl_sesion=>$sesion,
                	$this->tbl_feregistro=>date("d/m/Y H:i:s")
                	);         
                
                $result = $this->db->insert($this->clstabla,$tabla);
                return $result;
        }

        public function eliminarFranquicia($id)
        {
               $result = $this->db->delete($this->clstabla,array($this->tbl_idpk=>$id));
               return $result;
        }

        public function editarFranquicia($id,$descripcion)
        {
                $tabla = array (
                    $this->tbl_descripcion=>$descripcion,
                    $this->tbl_sesion=>$_SESSION['sess'],
                    $this->tbl_feregistro=>date("d/m/Y H:i:s")        
                    );         
                $result = $this->db->update($this->clstabla,$tabla,array($this->tbl_idpk => $id));
                return $result;
        }




}
?>

<?php
/**
*Clase de manejo de usuarios administradores
*
*/
class Moneda_model extends CI_Model {

        private  $clstabla='vc_m_moneda';
        private  $tbl_idpk='mn_id_moneda_a_pk';
        private  $tbl_descripcion='mn_descripcion_a';
        private  $tbl_estatus='mn_estatus_b';
        private  $tbl_sesion='mn_id_sesion_a';
        private  $tbl_feregistro='mn_fe_registro_t';
        private  $tbl_prefijo='mn_prefijo_a';


        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database(); //no es necesario por el autoload
        }

        public function getMoneda($id = FALSE)
        {
                if ($id === FALSE) {                                        
                        $query = $this->db->get($this->clstabla);
                        return $query->result();
                }                
                
                $query = $this->db->get_where($this->clstabla,array($this->tbl_idpk=>$id));
                
                return $query->result();//result_array();
        }


        public function getMonedasActiva()
        {
                
                $query = $this->db->get_where($this->clstabla,array($this->tbl_estatus=>'TRUE'));
                
                return $query->result();//result_array();
        }



        public function insertarMoneda($descripcion,$prefijo,$sesion)
        {
                $tabla = array (
                	$this->tbl_descripcion=>$descripcion,
                	$this->tbl_prefijo=>$prefijo,
                    $this->tbl_sesion=>$sesion,
                	$this->tbl_feregistro=>date("d/m/Y H:i:s")
                	);         
                
                $result = $this->db->insert($this->clstabla,$tabla);
                return $result;
        }

        public function eliminarMoneda($id) //modificacion a eliminacion logica
        {
               $result = $this->db->update($this->clstabla,array($this->tbl_estatus=>FALSE),array($this->tbl_idpk=>$id));
               return $result;
        }

        public function editarMoneda($id,$prefijo,$descripcion,$status)
        {
                $tabla = array (
                    $this->tbl_descripcion=>$descripcion,
                    $this->tbl_prefijo=>$prefijo,
                    $this->tbl_estatus=>$status,
                    $this->tbl_sesion=>$_SESSION['sess'],
                    $this->tbl_feregistro=>date("d/m/Y H:i:s")        
                    );         
                $result = $this->db->update($this->clstabla,$tabla,array($this->tbl_idpk => $id));
                return $result;
        }




}
?>

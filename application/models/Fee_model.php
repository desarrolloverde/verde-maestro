<?php
/**
*Clase de manejo de usuarios administradores
*
*/
class Fee_model extends CI_Model {

        private  $clstabla='vc_m_fee';
        private  $tbl_idpk='fe_id_fee_n_pk';
        private  $tbl_porcentaje='fe_porcentaje_fee_n';
        private  $tbl_estatus='fe_estatus_b';
        private  $tbl_sesion='fe_id_sesion_a';
        private  $tbl_feregistro='fe_fe_registro_t';
        private  $tbl_descripcion='fe_descripcion_fee';
        


        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database(); //no es necesario por el autoload
        }

        public function getFee($id = FALSE)
        {
                if ($id === FALSE) {                                        
                        $query = $this->db->get($this->clstabla);
                        return $query->result();
                }                
                
                $query = $this->db->get_where($this->clstabla,array($this->tbl_idpk=>$id));
                
                return $query->result();//result_array();
        }


        public function getFeeActivo()
        {
                
                $query = $this->db->get_where($this->clstabla,array($this->tbl_estatus=>'TRUE'));
                
                return $query->result();//result_array();
        }



        public function insertarFee($porcentaje,$descripcion,$sesion)
        {
                $tabla = array (
                    $this->tbl_porcentaje=>$porcentaje,
                    $this->tbl_descripcion=>$descripcion,
                    $this->tbl_sesion=>$sesion,
                    $this->tbl_feregistro=>date("d/m/Y H:i:s")
                    );         
                
                $result = $this->db->insert($this->clstabla,$tabla);
                return $result;
        }

        public function eliminarFee($id) //modificacion a eliminacion logica
        {
               $result = $this->db->update($this->clstabla,array($this->tbl_estatus=>FALSE),array($this->tbl_idpk=>$id));
               return $result;
        }

        public function editarFee($id,$porcentaje,$descripcion,$status)
        {
                $tabla = array (
                    $this->tbl_porcentaje=>$porcentaje,
                    $this->tbl_descripcion=>$descripcion,                    
                    $this->tbl_estatus=>$status,
                    $this->tbl_sesion=>$_SESSION['sess'],
                    $this->tbl_feregistro=>date("d/m/Y H:i:s")        
                    );         
                $result = $this->db->update($this->clstabla,$tabla,array($this->tbl_idpk => $id));
                return $result;
        }



}
?>

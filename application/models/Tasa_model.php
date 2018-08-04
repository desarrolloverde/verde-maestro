<?php
/**
*Clase de manejo de Tasas o valor del $$
*ts_id_tasa_a_pk, ts_valor_n, ts_id_moneda_a, ts_id_sesion_a, 
       ts_fe_registro_t
*/
class Tasa_model extends CI_Model {

        private  $clstabla='vc_m_tasa';
        private  $tbl_idpk='ts_id_tasa_a_pk';
        private  $tbl_valor='ts_valor_n';
        private  $tbl_idmoneda='ts_id_moneda_a';
        private  $tbl_sesion='ts_id_sesion_a';
        private  $tbl_feregistro='ts_fe_registro_t';
        private  $tbl_status='ts_estatus_b';
        


        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database(); //no es necesario por el autoload
        }

        public function getTasa($id)
        {
                //$query = $this->db->get_where($this->clstabla,array($this->tbl_idpk=>$id));
                $query = $this->db->query("SELECT ts_id_tasa_a_pk, ts_valor_n, ts_id_moneda_a, ts_id_sesion_a, 
                           ts_fe_registro_t,b.mn_prefijo_a as moneda FROM vc_m_tasa a INNER JOIN vc_m_moneda b ON a.ts_id_moneda_a=b.mn_id_moneda_a_pk where a.ts_id_tasa_a_pk='".$id."'");
                
                return $query->result();//result_array();
        }

        public function getTasasxMoneda($idmoneda)
        {
                $where=(isset($idmoneda)) ? "WHERE b.mn_id_moneda_a_pk= '".$idmoneda."'" : '';    
                $query = $this->db->query("SELECT ts_id_tasa_a_pk, ts_valor_n, ts_id_moneda_a, ts_id_sesion_a, ts_estatus_b, 
                           ts_fe_registro_t,b.mn_prefijo_a as moneda FROM vc_m_tasa a INNER JOIN vc_m_moneda b ON a.ts_id_moneda_a=b.mn_id_moneda_a_pk ".$where." order by ts_fe_registro_t desc LIMIT 10");
                return $query->result();//result_array();
        }

        public function getTasasxMonedaActiva($idmoneda)
        {
                                               
                        $query = $this->db->query("SELECT ts_id_tasa_a_pk, ts_valor_n, ts_id_moneda_a, ts_id_sesion_a, 
                           ts_fe_registro_t,b.mn_prefijo_a as moneda FROM vc_m_tasa A INNER JOIN vc_m_moneda b ON a.ts_id_moneda_a=b.mn_id_moneda_a_pk where a.ts_estatus_b=TRUE and b.mn_id_moneda_a_pk='".$idmoneda."'");
                        return $query->result();                                        
        }



        public function insertarTasa($valor,$idmoneda,$sesion)
        {
                $tabla = array (
                	$this->tbl_valor=>$valor,
                	$this->tbl_idmoneda=>$idmoneda,
                    $this->tbl_sesion=>$sesion,
                	$this->tbl_feregistro=>date("d/m/Y H:i:s")
                	);         
                $this->desactivarTasaxMoneda($idmoneda);
                $result = $this->db->insert($this->clstabla,$tabla);
                return $result;
        }

        public function desactivarTasaxMoneda($idmoneda)
        {
               $result = $this->db->update($this->clstabla,array($this->tbl_status=>FALSE),array($this->tbl_idmoneda=>$idmoneda));
               return $result;
        }

        public function eliminarTasa($id) //esta funcion no se usuará
        {
               $result = $this->db->delete($this->clstabla,array($this->tbl_idpk=>$id));
               return $result;
        }

        public function editarTasa($id) //Funcion que tampoco se usara
        {
                $tabla = array (
                    $this->tbl_valor=>$descripcion,
                    $this->tbl_idmoneda=>$idmoneda,
                    $this->tbl_sesion=>$_SESSION['sess'],
                    $this->tbl_feregistro=>date("d/m/Y H:i:s")        
                    );         
                $result = $this->db->update($this->clstabla,$tabla,array($this->tbl_idpk => $id));
                return $result;
        }




}
?>

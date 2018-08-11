<?php
/**
*Clase de manejo de Cuentas de envio
*
SELECT cp_id_tarjeta_i_pk, cp_numero_tarjeta_i_pk, cd_id_tarjeta_pk, 
       cp_nombre_tarjeta_a, cp_fecha_vencimiento_d, cp_cvv_i, cp_direcccion_a, 
       cp_id_sesion_a, cp_fe_registro_t,cp_us_verumcard_a_fk
  FROM verumbd.vc_m_reg_cuenta_pago;
*/
class Cuentapago_model extends CI_Model {

        private  $clstabla='vc_m_reg_cuenta_pago';
        private  $tbl_idpk='cp_id_tarjeta_i_pk';
        private  $tbl_nutarjeta='cp_numero_tarjeta_i_pk';
        private  $tbl_idtarjeta='cd_id_tarjeta_pk';//franquicia
        private  $tbl_nomapetarjeta='cp_nombre_tarjeta_a';
        private  $tbl_fevencimiento='cp_fecha_vencimiento_d';
        private  $tbl_cvv='cp_cvv_i';
        private  $tbl_direccion='cp_direcccion_a';
        private  $tbl_idsesion='cp_id_sesion_a';
        private  $tbl_feregistro='cp_fe_registro_t';


        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database(); //no es necesario por el autoload
        }

        public function getCuentapago($id = FALSE)
        {
                if ($id === FALSE) {                                        
                    //$query = $this->db->get($this->clstabla);
                    $query = $this->db->query("SELECT cp_id_tarjeta_i_pk, cp_numero_tarjeta_i_pk, cd_id_tarjeta_pk, 
       cp_nombre_tarjeta_a, cp_fecha_vencimiento_d, cp_cvv_i, cp_direcccion_a, 
       cp_id_sesion_a, cp_fe_registro_t, B.tt_descripcion_a as franquicia
  FROM vc_m_reg_cuenta_pago A INNER JOIN vc_m_franquicia B ON A.cd_id_tarjeta_pk = B.tt_id_tarjeta_pk");
                    return $query->result();
                } else {
                    $query = $this->db->query("SELECT cp_id_tarjeta_i_pk, cp_numero_tarjeta_i_pk, cd_id_tarjeta_pk, 
       cp_nombre_tarjeta_a, cp_fecha_vencimiento_d, cp_cvv_i, cp_direcccion_a, 
       cp_id_sesion_a, cp_fe_registro_t, B.tt_descripcion_a as franquicia
  FROM vc_m_reg_cuenta_pago A INNER JOIN vc_m_franquicia B ON A.cd_id_tarjeta_pk = B.tt_id_tarjeta_pk
  WHERE cp_id_tarjeta_i_pk=".$id);
                    return $query->result();
                }               
                
                //result_array(); 
        }



        public function insertarCuentapago($nutarjeta,$idtarjeta,$nomape,$fevencimiento,$cvv,$direccion,$sesion)
        {
                $tabla = array (
                    $this->tbl_nutarjeta=>$nutarjeta,
                    $this->tbl_idtarjeta=>$idtarjeta,
                	$this->tbl_nomapetarjeta=>$nomape,
                    $this->tbl_fevencimiento=>$fevencimiento,
                    $this->tbl_cvv=>$cvv,
                    $this->tbl_direccion=>$direccion,
                    $this->tbl_idsesion=>$sesion,
                	$this->tbl_feregistro=>date("d/m/Y H:i:s")
                    
                );
                $result = $this->db->insert($this->clstabla,$tabla);
                return $result;
        }

        public function eliminarCuentaenvio($id)
        {
               $result = $this->db->delete($this->clstabla,array($this->tbl_idpk=>$id));
               return $result;
        }

        public function editarCuentaenvio($id,$nucuenta,$idtarjeta,$nomape,$fevencimiento,$cvv,$direccion,$sesion)
        {
                $tabla = array (
//               
                    $this->tbl_idpk=>$id,
                    $this->tbl_nutarjeta=>$nucuenta,
                    $this->tbl_idtarjeta=>$idtarjeta,
                    $this->tbl_nomapetarjeta=>$nomape,
                    $this->tbl_fevencimiento=>$fevencimiento,
                    $this->tbl_cvv=>$cvv,
                    $this->tbl_direccion=>$direccion,
                    $this->tbl_idsesion=>$sesion,
                    $this->tbl_feregistro=>date("d/m/Y H:i:s")
                    );              
                $result = $this->db->update($this->clstabla,$tabla,array($this->tbl_idpk => $id));
                return $result;
        }


        public function getCuentaPagoxUsuario($idusuario)
        {
                
                    $query = $this->db->query("SELECT cp_id_tarjeta_i_pk, cp_numero_tarjeta_i_pk, cd_id_tarjeta_pk, 
                           cp_nombre_tarjeta_a, cp_fecha_vencimiento_d, cp_cvv_i, cp_direcccion_a, 
                           cp_id_sesion_a, cp_fe_registro_t, B.tt_descripcion_a as franquicia
                      FROM vc_m_reg_cuenta_pago A INNER JOIN vc_m_franquicia B ON A.cd_id_tarjeta_pk = B.tt_id_tarjeta_pk
                      INNER JOIN vc_sesiones_vrcd C on a.cp_id_sesion_a = C.ss_id_sesion_a_pk 
                      INNER JOIN vc_m_usuario_verumcard D on C.ss_us_verumcard_a_pk = D.uv_us_verumcard_a_pk
                      WHERE D.uv_us_verumcard_a_pk='".$idusuario."'");
                    return $query->result();
                             
                
                //result_array(); 
        }

        public function getIDCuentaPagoxsesion($nutarjeta,$idsesion)
        {
        
            $where = array($this->tbl_idsesion=>$idsesion,
                            $this->tbl_nutarjeta=>$nutarjeta);     
            $this->db->order_by($this->tbl_feregistro, 'DESC');
            $this->db->limit(1);
            $query = $this->db->get_where($this->clstabla,$where);
            $idctapago=$query->result();
            return $idctapago[0]->cp_id_tarjeta_i_pk;
        //result_array(); 
        }



}
?>

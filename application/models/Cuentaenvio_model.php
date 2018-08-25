<?php
/**
*Clase de manejo de Cuentas de envio
*

*/
class Cuentaenvio_model extends CI_Model {

        private  $clstabla='vc_m_reg_cuentas_envio';
        private  $tbl_idpk='rc_id_cuenta_a_pk';
        private  $tbl_nucuenta='rc_numero_cuenta_a';
        private  $tbl_iduser='rc_us_verumcard_a_pk';
        private  $tbl_frefijoci='rc_prefijo_a';
        private  $tbl_cedula='ct_ced_rif_a';
        private  $tbl_nbtitular='rc_nombre_titular_a';
        private  $tbl_email='rc_email_a';
        private  $tbl_idbanco='rc_id_banco_a';
        private  $tbl_feregistro='rc_fe_registro_t';
        private  $tbl_estatus='rc_estatus_b';


        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database(); //no es necesario por el autoload
        }

        public function getCuentaenvio($id = FALSE)
        {
                if ($id === FALSE) {                                        
                    //$query = $this->db->get($this->clstabla);
                    $query = $this->db->query("SELECT rc_id_cuenta_a_pk, rc_numero_cuenta_a, rc_us_verumcard_a_pk, rc_prefijo_a,
                     ct_ced_rif_a, rc_nombre_titular_a, rc_email_a, rc_id_banco_a, rc_fe_registro_t, 
                     B.bc_entidad_bancaria_a AS banco FROM vc_m_reg_cuentas_envio A INNER JOIN vc_m_bancos B ON rc_id_banco_a = B.bc_id_banco_a_pk WHERE A.rc_estatus_b=TRUE");
                    return $query->result();
                } else {
                    $query = $this->db->query("SELECT rc_id_cuenta_a_pk, rc_numero_cuenta_a, rc_us_verumcard_a_pk, rc_prefijo_a,
                     ct_ced_rif_a, rc_nombre_titular_a, rc_email_a, rc_id_banco_a, rc_fe_registro_t, 
                     B.bc_entidad_bancaria_a AS banco FROM vc_m_reg_cuentas_envio A INNER JOIN vc_m_bancos B ON rc_id_banco_a = B.bc_id_banco_a_pk WHERE A.rc_estatus_b=TRUE AND rc_id_cuenta_a_pk='".$id."'");
                    return $query->result();
                }               
                
                //result_array(); 
        }



        public function insertarCuentaenvio($nucuenta,$nbusuario,$prefnac,$cedulatit,$nbtit,$email,$idbanco)
        {
                $tabla = array (
                    $this->tbl_nucuenta=>$nucuenta,
                    $this->tbl_iduser=>$nbusuario,
                	$this->tbl_frefijoci=>$prefnac,
                    $this->tbl_cedula=>$cedulatit,
                    $this->tbl_nbtitular=>$nbtit,
                    $this->tbl_email=>$email,
                    $this->tbl_idbanco=>$idbanco,
                	$this->tbl_feregistro=>date("d/m/Y H:i:s")
                	);         
                
                $result = $this->db->insert($this->clstabla,$tabla);
                return $result;
        }

        public function eliminarCuentaenvio($id)
        {
               $result = $this->db->update($this->clstabla,array($this->tbl_estatus=>FALSE),array($this->tbl_idpk=>$id));
               return $result;
        }

        public function editarCuentaenvio($id,$nucuenta,$prefnac,$cedulatit,$nbtit,$email,$idbanco)
        {
                $tabla = array (
//               
                    $this->tbl_idpk=>$id,
                    $this->tbl_nucuenta=>$nucuenta,
                    $this->tbl_frefijoci=>$prefnac,
                    $this->tbl_cedula=>$cedulatit,
                    $this->tbl_nbtitular=>$nbtit,
                    $this->tbl_email=>$email,
                    $this->tbl_idbanco=>$idbanco,
                    $this->tbl_feregistro=>date("d/m/Y H:i:s")
                    );              
                $result = $this->db->update($this->clstabla,$tabla,array($this->tbl_idpk => $id));
                return $result;
        }

        public function correccionCuentaenvio($idcta,$nucuenta,$prefnac,$cedulatit,$nbtit,$email)
        {
                $tabla = array (
//               
                    $this->tbl_idpk=>$idcta,
                    $this->tbl_nucuenta=>$nucuenta,
                    $this->tbl_frefijoci=>$prefnac,
                    $this->tbl_cedula=>$cedulatit,
                    $this->tbl_nbtitular=>$nbtit,
                    $this->tbl_email=>$email,
                    $this->tbl_feregistro=>date("d/m/Y H:i:s")
                    );              
                $result = $this->db->update($this->clstabla,$tabla,array($this->tbl_idpk => $idcta));
                return $result;
        }

        public function getCuentaenvioxUsuario($idusuario)
        {
                
                    $query = $this->db->query("SELECT rc_id_cuenta_a_pk, rc_numero_cuenta_a, rc_us_verumcard_a_pk, rc_prefijo_a,
                     ct_ced_rif_a, rc_nombre_titular_a, rc_email_a, rc_id_banco_a, rc_fe_registro_t, 
                     B.bc_entidad_bancaria_a AS banco FROM vc_m_reg_cuentas_envio A INNER JOIN vc_m_bancos B ON rc_id_banco_a = B.bc_id_banco_a_pk WHERE rc_us_verumcard_a_pk='".$idusuario."'");
                    return $query->result();
                             
                
                //result_array(); 
        }



}
?>

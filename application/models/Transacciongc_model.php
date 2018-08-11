<?php
/**
*Clase de manejo de transacciones con giftcard
*
SELECT tg_numero_ref_n_pk, tg_id_fee_n, tg_numero_tarjeta_a, tg_monto_fee_us_n, 
       tg_monto_disp_us_n, tg_promo_real_us_n, tg_monto_total_bs_n, 
       tg_codigo_estatus_a, tg_id_sesion_a, tg_fe_registro_t, tg_cuenta_envio_a, 
       tg_id_tarjeta_i_fk, tg_monto_tasa_us_n, tg_id_tasa_a_fk, tg_codigo_estatus_i
  FROM verumbd.vc_m_transaccion_giftcard;
*/
class Transacciongc_model extends CI_Model {

        private  $clstabla='vc_m_transaccion_giftcard';
        private  $tbl_idpk='tg_numero_ref_n_pk';
        private  $tbl_porcfee='tg_porcentaje_fee_n';
        private  $tbl_nutarjeta='tg_numero_tarjeta_a';
        private  $tbl_montofee='tg_monto_fee_us_n';
        private  $tbl_montodisp='tg_monto_disp_us_n';
        private  $tbl_promoreal='tg_promo_real_us_n';
        private  $tbl_montotot='tg_monto_total_bs_n';
        private  $tbl_codstatus='tg_codigo_estatus_i';
        private  $tbl_idsesion='tg_id_sesion_a';
        private  $tbl_cuentaenv='tg_cuenta_envio_a';
        private  $tbl_idtarjeta='tg_id_tarjeta_i_fk';
        private  $tbl_montotasa='tg_monto_tasa_us_n';
        private  $tbl_idtasa='tg_id_tasa_a_fk';
        private  $tbl_feregistro='tg_fe_registro_t';


        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database(); //no es necesario por el autoload
        }

        public function getTransacciongc($id = FALSE)
        {
                if ($id === FALSE) {                                        
                    //$query = $this->db->get($this->clstabla);
                    $query = $this->db->query("SELECT tg_numero_ref_n_pk, tg_porcentaje_fee_n, tg_numero_tarjeta_a, tg_monto_fee_us_n, 
                       tg_monto_disp_us_n, tg_promo_real_us_n, tg_monto_total_bs_n, 
                       tg_codigo_estatus_a, tg_id_sesion_a, tg_fe_registro_t, tg_cuenta_envio_a, 
                       tg_id_tarjeta_i_fk, tg_monto_tasa_us_n, tg_id_tasa_a_fk
                  FROM verumbd.vc_m_transaccion_giftcard");
                    return $query->result();
                } else {
                    $query = $this->db->query("SELECT tg_numero_ref_n_pk, tg_porcentaje_fee_n, tg_numero_tarjeta_a, tg_monto_fee_us_n, 
       tg_monto_disp_us_n, tg_promo_real_us_n, tg_monto_total_bs_n, 
       tg_codigo_estatus_a, tg_id_sesion_a, tg_fe_registro_t, tg_cuenta_envio_a, 
       tg_id_tarjeta_i_fk, tg_monto_tasa_us_n, tg_id_tasa_a_fk
  FROM verumbd.vc_m_transaccion_giftcard WHERE tg_numero_ref_n_pk='".$id."'");
                    return $query->result();
                }               
                
                //result_array(); 
        }



        public function insertarTransacciongc($porcfee,$nutarjeta,$montofee,$montotot,$nuctaenvio,$idtarjeta,$montotasa,$idtasa)
        {

                $tabla = array (
                    $this->tbl_porcfee=>$porcfee,
                    $this->tbl_nutarjeta=>$nutarjeta,
                	$this->tbl_montofee=>$montofee,
                    //$this->tbl_montodisp=>$montodisp, //validar como trabajar
                    //$this->tbl_promoreal=>$promo, // validar como trabajar
                    $this->tbl_montotot=>$montotot,
                    $this->tbl_codstatus=>1,
                    $this->tbl_idsesion=>$_SESSION['sess'],
                    $this->tbl_cuentaenv=>$nuctaenvio,
                    $this->tbl_idtarjeta=>$idtarjeta,
                    $this->tbl_montotasa=>$montotasa,
                    $this->tbl_idtasa=>$idtasa,
                	$this->tbl_feregistro=>date("d/m/Y H:i:s")
                	);         
                
                $result = $this->db->insert($this->clstabla,$tabla);
                return $result;
        }

        public function actualizarTransacciongc($id,$idstatus)
        {
               $result = $this->db->update($this->clstabla,array($this->tbl_codstatus=>$idstatus),array($this->tbl_idpk=>$id));
               return $result;
        }


        public function getTransacciongcxUsuario($idusuario)
        {
                
                    $query = $this->db->query("SELECT tg_numero_ref_n_pk, tg_porcentaje_fee_n, tg_numero_tarjeta_a, tg_monto_fee_us_n, 
                       tg_monto_disp_us_n, tg_promo_real_us_n, tg_monto_total_bs_n, 
                        tg_id_sesion_a, tg_fe_registro_t, tg_cuenta_envio_a, tg_codigo_estatus_i
                       tg_id_tarjeta_i_fk, tg_monto_tasa_us_n, tg_id_tasa_a_fk, et_descripcion_a as status,
                       E.rc_nombre_titular_a||', '||F.bc_entidad_bancaria_a||', Cta:'||E.rc_numero_cuenta_a as ctadestino
                        FROM vc_m_transaccion_giftcard A INNER JOIN vc_sesiones_vrcd B ON A.tg_id_sesion_a=B.ss_id_sesion_a_pk
                        INNER JOIN vc_m_usuario_verumcard C ON  B.ss_us_verumcard_a_pk=C.uv_us_verumcard_a_pk
                        INNER JOIN vc_m_estatus_transaccion D on A.tg_codigo_estatus_i=D.et_codigo_estatus_i
                        INNER JOIN vc_m_reg_cuentas_envio E on A.tg_cuenta_envio_a=E.rc_id_cuenta_a_pk
                        INNER JOIN vc_m_bancos F on E.rc_id_banco_a=F.bc_id_banco_a_pk
                        WHERE C.uv_us_verumcard_a_pk='".$idusuario."'");
                    return $query->result();
        }

        public function getIDTransgcxsesion($nutarjeta,$idsesion)
        {
        
            $where = array($this->tbl_idsesion=>$idsesion,
                            $this->tbl_nutarjeta=>$nutarjeta); 
                            $this->db->limit(1);    
            $this->db->order_by($this->tbl_feregistro, 'DESC');
            $query = $this->db->get_where($this->clstabla,$where);
            $idtransgc=$query->result();
            return $idtransgc[0]->tg_numero_ref_n_pk;
        //result_array(); 
        }



        public function insertarTransacciongcRelacion($idtransgc,$idgc,$montogc) {
            
            $tabla= array('tg_numero_ref_n_pk'=>$idtransgc,
                          'tg_id_gifcard_i_pk'=>$idgc,
                          'tg_monto_gifcard_us_n'=>$montogc);
            $result=$this->db->insert('vc_d_transaccion_giftcard',$tabla);
            return $result;



        }


}
?>

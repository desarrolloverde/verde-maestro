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
                        tg_id_sesion_a, tg_fe_registro_t, tg_cuenta_envio_a, tg_codigo_estatus_i,C.uv_nombre_a||' '||C.uv_apellido_a as usuario,
                       tg_id_tarjeta_i_fk, tg_monto_tasa_us_n, tg_id_tasa_a_fk, et_descripcion_a as status,
                       E.rc_nombre_titular_a||', '||F.bc_entidad_bancaria_a||', Cta:'||E.rc_numero_cuenta_a as ctadestino,
                       H.us_nombre_a ||' '||H.us_apellido_a as Asignado, H.us_id_usuario_a_pk as idusad     
                        FROM vc_m_transaccion_giftcard A INNER JOIN vc_sesiones_vrcd B ON A.tg_id_sesion_a=B.ss_id_sesion_a_pk
                        INNER JOIN vc_m_usuario_verumcard C ON  B.ss_us_verumcard_a_pk=C.uv_us_verumcard_a_pk
                        INNER JOIN vc_m_estatus_transaccion D on A.tg_codigo_estatus_i=D.et_codigo_estatus_i
                        INNER JOIN vc_m_reg_cuentas_envio E on A.tg_cuenta_envio_a=E.rc_id_cuenta_a_pk
                        INNER JOIN vc_m_bancos F on E.rc_id_banco_a=F.bc_id_banco_a_pk
                        LEFT JOIN vc_m_asigna_transferencia G on A.tg_numero_ref_n_pk=G.as_numero_ref_n_pk
                        LEFT JOIN vc_m_us_administrativos H ON G.as_id_usuario_a_pk=H.us_id_usuario_a_pk");
                    return $query->result();
                } else {
                    $query = $this->db->query("SELECT tg_numero_ref_n_pk, tg_porcentaje_fee_n, tg_numero_tarjeta_a, tg_monto_fee_us_n, 
                       tg_monto_disp_us_n, tg_promo_real_us_n, tg_monto_total_bs_n, 
                        tg_id_sesion_a, tg_fe_registro_t, tg_cuenta_envio_a, tg_codigo_estatus_i,C.uv_nombre_a||' '||C.uv_apellido_a as usuario,
                       tg_id_tarjeta_i_fk, tg_monto_tasa_us_n, tg_id_tasa_a_fk, et_descripcion_a as status,
                       E.rc_nombre_titular_a||', '||F.bc_entidad_bancaria_a||', Cta:'||E.rc_numero_cuenta_a as ctadestino,
                       H.us_nombre_a ||' '||H.us_apellido_a as Asignado, H.us_id_usuario_a_pk as idusad     
                        FROM vc_m_transaccion_giftcard A INNER JOIN vc_sesiones_vrcd B ON A.tg_id_sesion_a=B.ss_id_sesion_a_pk
                        INNER JOIN vc_m_usuario_verumcard C ON  B.ss_us_verumcard_a_pk=C.uv_us_verumcard_a_pk
                        INNER JOIN vc_m_estatus_transaccion D on A.tg_codigo_estatus_i=D.et_codigo_estatus_i
                        INNER JOIN vc_m_reg_cuentas_envio E on A.tg_cuenta_envio_a=E.rc_id_cuenta_a_pk
                        INNER JOIN vc_m_bancos F on E.rc_id_banco_a=F.bc_id_banco_a_pk
                        LEFT JOIN vc_m_asigna_transferencia G on A.tg_numero_ref_n_pk=G.as_numero_ref_n_pk
                        LEFT JOIN vc_m_us_administrativos H ON G.as_id_usuario_a_pk=H.us_id_usuario_a_pk WHERE tg_numero_ref_n_pk='".$id."'");
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
                        tg_id_sesion_a, tg_fe_registro_t, tg_cuenta_envio_a, tg_codigo_estatus_i, C.uv_nombre_a||' '||C.uv_apellido_a as usuario,
                       tg_id_tarjeta_i_fk, tg_monto_tasa_us_n, tg_id_tasa_a_fk, et_descripcion_a as status,
                       E.rc_nombre_titular_a||', '||F.bc_entidad_bancaria_a||', Cta:'||E.rc_numero_cuenta_a as ctadestino,
                       H.us_nombre_a ||' '||H.us_apellido_a as Asignado, H.us_id_usuario_a_pk as idusad     
                        FROM vc_m_transaccion_giftcard A INNER JOIN vc_sesiones_vrcd B ON A.tg_id_sesion_a=B.ss_id_sesion_a_pk
                        INNER JOIN vc_m_usuario_verumcard C ON  B.ss_us_verumcard_a_pk=C.uv_us_verumcard_a_pk
                        INNER JOIN vc_m_estatus_transaccion D on A.tg_codigo_estatus_i=D.et_codigo_estatus_i
                        INNER JOIN vc_m_reg_cuentas_envio E on A.tg_cuenta_envio_a=E.rc_id_cuenta_a_pk
                        INNER JOIN vc_m_bancos F on E.rc_id_banco_a=F.bc_id_banco_a_pk
                        LEFT JOIN vc_m_asigna_transferencia G on A.tg_numero_ref_n_pk=G.as_numero_ref_n_pk
                        LEFT JOIN vc_m_us_administrativos H ON G.as_id_usuario_a_pk=H.us_id_usuario_a_pk
                        WHERE C.uv_us_verumcard_a_pk='".$idusuario."'");
                    return $query->result();
        }

        public function getTransacciongcxIdestatus($idestatus)
        {
                
                    $query = $this->db->query("SELECT tg_numero_ref_n_pk, tg_porcentaje_fee_n, tg_numero_tarjeta_a, tg_monto_fee_us_n, 
                       tg_monto_disp_us_n, tg_promo_real_us_n, tg_monto_total_bs_n, 
                        tg_id_sesion_a, tg_fe_registro_t, tg_cuenta_envio_a, tg_codigo_estatus_i, C.uv_nombre_a||' '||C.uv_apellido_a as usuario,
                       tg_id_tarjeta_i_fk, tg_monto_tasa_us_n, tg_id_tasa_a_fk, et_descripcion_a as status,
                       E.rc_nombre_titular_a||', '||F.bc_entidad_bancaria_a||', Cta:'||E.rc_numero_cuenta_a as ctadestino,
                       H.us_nombre_a ||' '||H.us_apellido_a as Asignado, H.us_id_usuario_a_pk as idusad     
                        FROM vc_m_transaccion_giftcard A INNER JOIN vc_sesiones_vrcd B ON A.tg_id_sesion_a=B.ss_id_sesion_a_pk
                        INNER JOIN vc_m_usuario_verumcard C ON  B.ss_us_verumcard_a_pk=C.uv_us_verumcard_a_pk
                        INNER JOIN vc_m_estatus_transaccion D on A.tg_codigo_estatus_i=D.et_codigo_estatus_i
                        INNER JOIN vc_m_reg_cuentas_envio E on A.tg_cuenta_envio_a=E.rc_id_cuenta_a_pk
                        INNER JOIN vc_m_bancos F on E.rc_id_banco_a=F.bc_id_banco_a_pk
                        LEFT JOIN vc_m_asigna_transferencia G on A.tg_numero_ref_n_pk=G.as_numero_ref_n_pk
                        LEFT JOIN vc_m_us_administrativos H ON G.as_id_usuario_a_pk=H.us_id_usuario_a_pk
                        WHERE tg_codigo_estatus_i=".$idestatus." AND G.as_estatus_b=TRUE");
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
        /***
        *Retorna arreglo con el conteo de las transaciones
        *vargason
        */
        public function getcountTransaccionesxEstatus() {
            
            $query = $this->db->query("SELECT  et_codigo_estatus_i as id, et_descripcion_a as status, 
                    count(tg_codigo_estatus_i) as total
                    FROM vc_m_transaccion_giftcard RIGHT JOIN vc_m_estatus_transaccion ON et_codigo_estatus_i = tg_codigo_estatus_i
                    GROUP BY et_codigo_estatus_i, et_descripcion_a
                    ORDER BY et_codigo_estatus_i ASC");
            
            return $query->result();
        }

        /***
        *Retorna arreglo con el conteo de las transaciones POR CLIENTE
        *vargason
        */
        public function getcountTransaccionesxEstatuscliente() {
            
            $query = $this->db->query("SELECT     (CASE
                                        WHEN et_codigo_estatus_i IN (1,2,3) THEN 
                                            '1,2,3'
                                        ELSE 
                                            TO_CHAR(et_codigo_estatus_i,'9')
                                        END) 
                                        as id,

                                        (CASE
                                        WHEN et_codigo_estatus_i IN (1,2,3) THEN 
                                            'EN PROGRESO'
                                        ELSE 
                                            et_descripcion_a
                                        END)
                                        as status, 
                                    count(tg_codigo_estatus_i) as total
                                    FROM vc_m_transaccion_giftcard RIGHT JOIN vc_m_estatus_transaccion ON et_codigo_estatus_i = tg_codigo_estatus_i
                                    GROUP BY id, status
                                    ORDER BY id ASC");
            
            return $query->result();



        }
        public function getTransacciongcxStatusxpagina($idestatus,$limit, $start) 
            {
                $asignado=($idestatus==1) ? "" : " AND G.as_estatus_b=TRUE";
                $query = $this->db->query("SELECT tg_numero_ref_n_pk, tg_porcentaje_fee_n, tg_numero_tarjeta_a, tg_monto_fee_us_n, 
                       tg_monto_disp_us_n, tg_promo_real_us_n, tg_monto_total_bs_n, 
                        tg_id_sesion_a, tg_fe_registro_t, tg_cuenta_envio_a, tg_codigo_estatus_i,C.uv_nombre_a||' '||C.uv_apellido_a as usuario,
                       tg_id_tarjeta_i_fk, tg_monto_tasa_us_n, tg_id_tasa_a_fk, et_descripcion_a as status,
                       E.rc_nombre_titular_a||', '||F.bc_entidad_bancaria_a||', Cta:'||E.rc_numero_cuenta_a as ctadestino,
                       H.us_nombre_a ||' '||H.us_apellido_a as Asignado, H.us_id_usuario_a_pk as idusad     
                        FROM vc_m_transaccion_giftcard A INNER JOIN vc_sesiones_vrcd B ON A.tg_id_sesion_a=B.ss_id_sesion_a_pk
                        INNER JOIN vc_m_usuario_verumcard C ON  B.ss_us_verumcard_a_pk=C.uv_us_verumcard_a_pk
                        INNER JOIN vc_m_estatus_transaccion D on A.tg_codigo_estatus_i=D.et_codigo_estatus_i
                        INNER JOIN vc_m_reg_cuentas_envio E on A.tg_cuenta_envio_a=E.rc_id_cuenta_a_pk
                        INNER JOIN vc_m_bancos F on E.rc_id_banco_a=F.bc_id_banco_a_pk
                        LEFT JOIN vc_m_asigna_transferencia G on A.tg_numero_ref_n_pk=G.as_numero_ref_n_pk
                        LEFT JOIN vc_m_us_administrativos H ON G.as_id_usuario_a_pk=H.us_id_usuario_a_pk
                        WHERE tg_codigo_estatus_i in (".$idestatus.")".$asignado." LIMIT ".$limit." OFFSET ".$start);
                    //return $query->result();
                //$this->db->limit($limit, $start);
                //$query = $this->db->get("users");
         
                if ($query->num_rows() > 0) 
                {
                    foreach ($query->result() as $row) 
                    {
                        $data[] = $row;
                    }
                     
                    return $data;
                }
         
                return false;
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

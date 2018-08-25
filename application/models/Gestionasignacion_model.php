<?php
/**
*
*@Clase modelo donde se maneja la gestion de transacciones y de transferencias
*@Gestiones son: Asignar, Ejecutar, Cancelar
*@Maneja 3 tablas distintas 
*@Autor: Osmer vargas
*@fecha de desarrollo: 16/08/18 
*/ //Gestiontrans
class Gestionasignacion_model extends CI_Model {
        /*Datos de la tabla de asignacion**/
        private  $clstabla_asig='vc_m_asigna_transferencia';
        private  $tbl_idpk_asig='as_id_asignacion';
        private  $tbl_nrotrans_asig='as_numero_ref_n_pk';
        private  $tbl_usuario_asig='as_id_usuario_a_pk';
        private  $tbl_sesion_asig='as_id_sesion_a_pk';
        private  $tbl_feregistro_asig='as_fe_registro_t';
        private  $tbl_estatus_asig='as_estatus_b';
    
        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database(); //no es necesario por el autoload
        }


        public function insertarAsignacion($nrotransaccion,$usuario,$sesion)
        {
                $tabla = array (
                    $this->tbl_nrotrans_asig=>$nrotransaccion,
                    $this->tbl_usuario_asig=>$usuario,
                    $this->tbl_sesion_asig=>$sesion,
                    $this->tbl_feregistro_asig=>date("d/m/Y H:i:s")
                    );         
                $result = $this->db->insert($this->clstabla_asig,$tabla);
                return $result;
        }
        public function actualizarAsignacion($nrotransaccion,$usuario,$sesion)
        {
                $tabla = array (
                    $this->tbl_estatus_asig=>FALSE
                    ); 
                $where= array($this->tbl_nrotrans_asig=>$nrotransaccion);
                $result = $this->db->update($this->clstabla_asig,$tabla,$where);
                if ($result) {
                    $result2=$this->insertarAsignacion($nrotransaccion,$usuario,$sesion);
                }
                return $result2;
        }

        public function getnumAsignacionxTransaccion($nrotransaccion) {
            $tabla= array (
                $this->tbl_nrotrans_asig=>$nrotransaccion
            );
            $query = $this->db->get_where($this->clstabla_asig,$tabla);
            return $query->result();
        }

        

        public function getAnalistaAsignadoxTrans($nrotransaccion)
        {
                $query = $this->db->query("SELECT tg_numero_ref_n_pk AS referencia, tg_codigo_estatus_i as estatustrans, us_id_usuario_a_pk AS idusuario,
                            us_nombre_a||' '||us_apellido_a AS analista, us_email_a AS email, as_id_asignacion AS idasignacion, tg_monto_total_bs_n as monto,
                            gt_id_gestion as idtransferencia, us_id_a_pk AS corol, gt_ruta_recibo_transf AS fpath
                            FROM vc_m_transaccion_giftcard INNER JOIN vc_m_asigna_transferencia ON tg_numero_ref_n_pk=as_numero_ref_n_pk
                            INNER JOIN vc_m_us_administrativos ON as_id_usuario_a_pk = us_id_usuario_a_pk
                            LEFT JOIN vc_m_gestion_transferencia ON gt_id_asignacion = as_id_asignacion
                            LEFT JOIN vc_m_transferencia_cancelada ON gt_id_gestion = tc_id_gestion
                            WHERE  as_estatus_b = TRUE AND tg_numero_ref_n_pk = '".$nrotransaccion."'");
                return $query->result();
        }

       



}
?>

<?php

/**
*
*@Clase modelo donde se maneja la gestion de transacciones y de transferencias
*@Gestiones son: Asignar, Ejecutar, Cancelar
*@Maneja 3 tablas distintas 
*@Autor: Osmer vargas
*@fecha de desarrollo: 16/08/18 
*/
class Gestiontransferencia_model extends CI_Model {
        /*Datos de la tabla de asignacion**/

/*Datos de la tabla de Transferencia**/
        private  $clstabla_ejec='vc_m_gestion_transferencia';
        private  $tbl_idpk_ejec='gt_id_gestion';
        private  $tbl_monto_ejec='gt_monto_tranf_bs_n';
        private  $tbl_asignacion_ejec='gt_id_asignacion';
        private  $tbl_ruta_ejec='gt_ruta_recibo_transf';
        private  $tbl_estatus_ejec='gt_id_estatus_a';
        private  $tbl_nrotrans_ejec='gt_nu_transferencia';
        private  $tbl_feini_ejec='gt_fe_ini_gestion_t';
        private  $tbl_sesion_ejec='gt_id_sesion_a_pk';
        private  $tbl_feregistro_ejec='gt_fe_registro_t';



        public function cancelarTransferencia($nrotransfer,$txcancelacion)
        {
                $tabla = array (
                    $this->tbl_estatus_ejec=>'cancelada'
                    ); 
                $where= array($this->tbl_idpk_ejec=>$nrotransfer);
                $result = $this->db->update($this->clstabla_ejec,$tabla,$where);
                if ($result) {
                    $result2=$this->db->query("insert into vc_m_transferencia_cancelada (tc_id_gestion,tc_tx_descripcion_canc) 
                        values ('".$nrotransfer."','".$txcancelacion."')");
                }
                return $result2;
        }

        public function correccionTransferencia($nrotransfer)
        {
                $tabla = "vc_m_transferencia_cancelada";
                $campos = array (
                    'tc_bo_estatus'=>false
                    ); 
                $where= array('tc_id_gestion'=>$nrotransfer);
                $result = $this->db->update($tabla,$campos,$where);
                return $result;
        }

        public function insertarGestiontrans($monto,$idasignacion,$ruta,$estatus,$sesion,$nutransferencia)
        {
                $tabla = array (                   
                    $this->tbl_monto_ejec=>$monto,
                    $this->tbl_asignacion_ejec=>$idasignacion,
                    $this->tbl_ruta_ejec=>$ruta,
                    $this->tbl_estatus_ejec=>$estatus,
                    $this->tbl_sesion_ejec=>$sesion,
                    $this->tbl_nrotrans_ejec=>$nutransferencia,
                    $this->tbl_feini_ejec=>date("d/m/Y H:i:s"),
                    $this->tbl_feregistro_ejec=>date("d/m/Y H:i:s")
                    );         
                $result = $this->db->insert($this->clstabla_ejec,$tabla);
                return $result;
        }

        public function getnumTransferenciaxasignacion($nroasignacion) {
            $tabla= array (
                $this->tbl_asignacion_ejec=>$nroasignacion
            );
            $query = $this->db->get_where($this->clstabla_ejec,$tabla);
            return $query->result();
        }

}




?>
<?php
/**
*
*@Clase modelo donde se maneja la gestion de transacciones y de transferencias
*@Gestiones son: Asignar, Ejecutar, Cancelar
*@Maneja 3 tablas distintas 
*@Autor: Osmer vargas
*@fecha de desarrollo: 16/08/18 
*/
class Gestiontrans_model extends CI_Model {
        /*Datos de la tabla de asignacion**/
        private  $clstabla_asig='vc_m_asigna_transferencia';
        private  $tbl_idpk_asig='as_id_asignacion';
        private  $tbl_nrotrans_asig='as_numero_ref_n_pk';
        private  $tbl_usuario_asig='as_id_usuario_a_pk';
        private  $tbl_sesion_asig='as_id_sesion_a_pk';
        private  $tbl_feregistro_asig='as_fe_registro_t';

        /*Datos de la tabla de asignacion**/
        private  $clstabla_ejec='vc_m_gestion_transferencia';
        private  $tbl_idpk_ejec='gt_id_gestion';
        private  $tbl_monto_ejec='gt_monto_tranf_bs_n';
        private  $tbl_asignacion_ejec='gt_id_asignacion';
        private  $tbl_ruta_ejec='gt_ruta_recibo_transf';
        private  $tbl_estatus_ejec='gt_id_estatus_a';
        private  $tbl_feini_ejec='gt_fe_ini_gestion_t';
        private  $tbl_sesion_ejec='as_id_sesion_a_pk';
        private  $tbl_feregistro_ejec='gt_fe_registro_t';
        


        
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

        public function insertarGestiontrans($monto,$idasignacion,$ruta,$estatus,$sesion)
        {
                $tabla = array (                   
                    $this->tbl_monto_ejec=>$usuario,
                    $this->tbl_asignacion_ejec=>$usuario,
                    $this->tbl_ruta_ejec=>$usuario,
                     $this->tbl_estatus_ejec=>$usuario,
                    $this->tbl_sesion_ejec=>$usuario,
                    $this->tbl_feini_ejec=>date("d/m/Y H:i:s"),
                    $this->tbl_feregistro_ejec=>date("d/m/Y H:i:s")
                    );         
                $result = $this->db->insert($this->clstabla_ejec,$tabla);
                return $result;
        }

       



}
?>

<?php
/**
*En este modelo se debe establecer todo el llenado de tablas de seguridad
* sessiones, entre otros
*/


class Autenticacion_model extends CI_Model {

        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database();
        }

        public function crearSesion($idusuario) //averiguar porque aqui sale tpuser
        {
                $tabla = array (
                    'ss_us_verumcard_a_pk'=>$idusuario,
                    'ss_ip_a'=>$this->getUserIpAddress(),
                    'ss_puerto_a'=>'8080',
                    'ss_fe_ingreso_a'=>date("d/m/Y H:i:s")
                    );         
                
                $result = $this->db->insert('vc_sesiones_vrcd',$tabla);
                if ($result) {
                    $query=$this->db->query('SELECT last_value from sec_vc_sesiones_vrcd_ss_id_sesion_a_pk');
                    $idsess = $query->result_array();
                    //echo $idsess->last_value;
                    $_SESSION['sess'] = $idsess[0]['last_value'];
                }
                return $result;
        }
/*
*@Funcion para almacenar datos de la session
*@Autor  Osmer Vargas
*@Falta obtener numero de puerto
*/

        public function crearSesionAdmin($idusuario)
        {
                $tabla = array (
                    'sa_id_usuario_a_pk'=>$idusuario,
                    'sa_ip_a'=>$this->getUserIpAddress(),
                    'sa_puerto_a'=>'8080',
                    'sa_fe_ingreso_a'=>date("d/m/Y H:i:s")
                    );         
                
                $result = $this->db->insert('vc_sesiones_adm',$tabla);
                if ($result) {
                    $query=$this->db->query('SELECT last_value from seq_vc_sesiones_adm_sa_id_sesion_a_pk');
                    $idsess = $query->result_array();
                    //echo $idsess->last_value;
                    $_SESSION['sess'] = $idsess[0]['last_value'];
                }
                return $result;
        }
        public function cerrarSesion($idsess)
        {

                $this->db->where('ss_id_sesion_a_pk', $idsess);
                $result = $this->db->update('vc_sesiones_vrcd',array('ss_fe_alta_a' => date("d/m/Y H:i:s")));
                //return $result;
                return $result;

        }

        public function cerrarSesionAdmin($idsess)
        {

                
                $this->db->where('sa_id_sesion_a_pk', $idsess);
                $result = $this->db->update('vc_sesiones_adm',array('sa_fe_alta_a' => date("d/m/Y H:i:s")));
                //return $result;
                return $result;

        }

        function getUserIpAddress() {

                if (isset($_SERVER["HTTP_CLIENT_IP"]))
                {
                    return $_SERVER["HTTP_CLIENT_IP"];
                }
                elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
                {
                    return $_SERVER["HTTP_X_FORWARDED_FOR"];
                }
                elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
                {
                    return $_SERVER["HTTP_X_FORWARDED"];
                }
                elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
                {
                    return $_SERVER["HTTP_FORWARDED_FOR"];
                }
                elseif (isset($_SERVER["HTTP_FORWARDED"]))
                {
                    return $_SERVER["HTTP_FORWARDED"];
                }
                else
                {
                    return $_SERVER["REMOTE_ADDR"];
                } 

                //return '???'; // Retornamos '?' si no hay ninguna IP o no pase el filtro
            } 


} //fin del modelo
?>
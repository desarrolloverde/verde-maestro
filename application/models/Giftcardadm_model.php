<?php
/**
*Clase de Administracion  de Giftcards
* 
ig_id_gift_card_a character varying(3) NOT NULL, -- Código de la imágen  del gift
  ig_descripcion_a character varying(30) NOT NULL, -- Descripción la imagen
  ig_ruta_imagen_b character varying NOT NULL, -- Ruta de ubicacion de la imagén que identifica el gif card
  ig_estatus_b boolean NOT NULL DEFAULT true, -- Estatus del rol
  ig_id_sesion_a character(11) NOT NULL, -- Valor ID de la sesion
*/
class Giftcardadm_model extends CI_Model {

        private  $clstabla='vc_m_gifcard';
        private  $tbl_idpk='gf_id_gifcard_i_pk';
        private  $tbl_gcidimagen='gf_id_gift_card_a';
        private  $tbl_gcvalor='gf_valor_i';
        private  $tbl_estatus='gf_estatus_b';
        private  $tbl_sesion='gf_id_sesion_a';
        private  $tbl_feregistro='gf_fe_registro_t';
        /***Valores para trabajar con imagenes en otra tabla****/
        private  $clstablaimagen='vc_m_imagengift';
        private  $tbl_idpkimg='ig_id_gift_card_a';
        private  $tbl_ruta='ig_ruta_imagen_a';
        private  $tbl_descripcion='ig_descripcion_a';
        private  $tbl_estatusimg='ig_estatus_b';
        private  $tbl_sesionimg='ig_id_sesion_a';
        private  $tbl_feregistroimg='ig_fe_registro_t';


        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //$this->load->database(); //no es necesario por el autoload
        }

        public function getGiftcardadm($id = FALSE)
        {
                if ($id === FALSE) {                                        
                        $query = $this->db->query("SELECT gf_id_gifcard_i_pk, gf_id_gift_card_a, gf_valor_i, gf_estatus_b, 
       gf_id_sesion_a, gf_fe_registro_t, ig_ruta_imagen_a as ruta
  FROM vc_m_gifcard A LEFT JOIN vc_m_imagengift B ON  (A.gf_id_gifcard_i_pk=B.ig_id_gift_card_a) WHERE gf_estatus_b=TRUE");
                        return $query->result();
                }                
                
                $query = $this->db->query("SELECT gf_id_gifcard_i_pk, gf_id_gift_card_a, gf_valor_i, gf_estatus_b, 
       gf_id_sesion_a, gf_fe_registro_t, ig_ruta_imagen_a as ruta
  FROM vc_m_gifcard A LEFT JOIN vc_m_imagengift B ON  (A.gf_id_gifcard_i_pk=B.ig_id_gift_card_a) WHERE gf_estatus_b=TRUE AND gf_id_gifcard_i_pk='".$id."'");
                
                return $query->result();//result_array();
        }



        public function insertarGiftcardadm($valor,$idimg,$sesion)
        {
                $tabla = array (
                	$this->tbl_gcvalor=>$valor,
                    $this->tbl_gcidimagen=>$idimg,
                	$this->tbl_estatus=>TRUE,
                    $this->tbl_sesion=>$sesion,
                	$this->tbl_feregistro=>date("d/m/Y H:i:s")
                	);         
                
                $result = $this->db->insert($this->clstabla,$tabla);
                return $result;
        }

        public function insertarGiftcardadmImg($idgiftcard,$rutaimg,$sesion)
        {
                $tabla = array (
                    $this->tbl_ruta=>$rutaimg,
                    $this->tbl_idpkimg=>$idgiftcard,
                    $this->tbl_estatusimg=>TRUE,
                    $this->tbl_sesionimg=>$sesion,
                    $this->tbl_feregistroimg=>date("d/m/Y H:i:s")
                    );         
                
                $result = $this->db->insert($this->clstablaimagen,$tabla);
                return $result;
        }



        public function eliminarGiftcardadm($id)
        {
               $result = $this->db->delete($this->clstabla,array($this->tbl_idpk=>$id));
               return $result;
        }

        public function editarGiftcardadm($id,$valor,$idimg,$sesion)
        {
                $tabla = array (
                    $this->tbl_gcvalor=>$valor,
                    $this->tbl_gcidimagen=>$idimg,
                    //$this->tbl_estatus=>TRUE,
                    $this->tbl_sesion=>$sesion,
                    $this->tbl_feregistro=>date("d/m/Y H:i:s")
                    );         
                $result = $this->db->update($this->clstabla,$tabla,array($this->tbl_idpk => $id));
                return $result;
        }
        public function cambiarGiftcardadmImg($idgiftcard,$rutaimg,$sesion)
        {
            ////********DEBO VALIDAR SI EXISTE REGISTRO*********///
            $datos=$this->getGiftcardadm($idgiftcard);
            if (isset($datos)) {

                $tabla = array (
                     $this->tbl_ruta=>$rutaimg,
                    $this->tbl_idpkimg=>$idgiftcard,
                    $this->tbl_estatusimg=>TRUE,
                    $this->tbl_sesionimg=>$sesion,
                    $this->tbl_feregistroimg=>date("d/m/Y H:i:s")
                    );         
                $result = $this->db->update($this->clstablaimagen,$tabla,array($this->tbl_idpkimg => $idgiftcard));
                return $result;
            } else {
                $result = $this->db->insert($this->clstablaimagen,$tabla);
                return $result;
            }
        }

         public function getMaxidgc()
        {
                                                        
                    //$query = $this->db->get($this->clstabla);
                    //$query = $this->db->query("SELECT currval('seq_vc_m_giftcard_gf_id_giftcard_i_pk') as maxid");
                    $query = $this->db->query("SELECT last_value as maxid FROM seq_vc_m_giftcard_gf_id_giftcard_i_pk");
                    return $query->result();
                               
                
                //result_array(); 
        }




}
?>

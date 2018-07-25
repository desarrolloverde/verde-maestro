<?php
/*
 * Dynmic_menu.php
 */
class Dynamic_menu 
{
 
    private $ci;            // para CodeIgniter Super Global Referencias o variables globales
    private $id_menu        = 'id="menu"';
    private $class_menu        = 'class="menu"';
    private $class_parent    = 'class="parent"';
    private $class_last        = 'class="last"';
    // --------------------------------------------------------------------
    /**
     * PHP5        Constructor
     *
     */
    function __construct()
    {
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
    }
    // --------------------------------------------------------------------
     /**
     * build_menu($type)
     *
     * Description:
     *
     * builds the Dynaminc dropdown menu
     * $table allows for passing in a MySQL table name for different menu tables.
     * $type is for the type of menu to display ie; topmenu, mainmenu, sidebar menu
     * or a footer menu.
     *
     * @param    string    the MySQL database table name.
     * @param    string    the type of menu to display.
     * @return    string    $html_out using CodeIgniter achor tags.
     */
 
    public function build_menu($type)
    {
        $menu = array();
 
     $query = $this->ci->db->query("select *  from app_navmenu where idparent is null");
     $html_out="";
        // now we will build the dynamic menus.
        //$html_out  = "\t".'<div '.$this->id_menu.'>'."\n";
    
    // me despliega del query los rows de la base de datos que deseo utilizar
      foreach ($query->result() as $row)
            {
                $id = $row->id;
                $name = $row->name;
                $route = $row->route;
                $idparent = $row->idparent;
                $isdefault = $row->isdefault;
                //$title = $row->title;
                // $link_type = $row->link_type;
                // $page_id = $row->page_id;
                // $module_name = $row->module_name;
                // $url = $row->url;
                // $uri = $row->uri;
                // $dyn_group_id = $row->dyn_group_id;
                // $position = $row->position;
                // $target = $row->target;
                // $parent_id = $row->parent_id;
                // $is_parent = $row->is_parent;
                // $show_menu = $row->show_menu;
               
 //               if ($show_menu && $parent_id == 0)   // are we allowed to see this menu?



                    $childs=$this->get_childs($id);
 //               {

                    if ($childs)
                    {
                        $html_out .= '<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$name.'<span class="caret"></span></a><ul class="dropdown-menu">';
                        $html_out .= $childs;
                        $html_out .= '</ul>
                        </li>';

                    } else {
                    // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= '<li><a href="'. $route.'">'.$name.'</a></li>';
 
                    }
                   
   //            } */
 
             }
 
 
        return $html_out;
    }
     /**
     * get_childs($menu, $parent_id) - SEE Above Method.
     *
     * Description:
     *
     * Builds all child submenus using a recurse method call.
     *
     * @param    mixed    $id
     * @param    string    $id usuario
     * @return    mixed    $html_out if has subcats else FALSE
     */
    private function get_childs($id)
    {
        $has_subcats = FALSE;
 
        $html_out2  = '';
        //$html_out .= "\n\t\t\t\t".'<div>'."\n";
        //$html_out .= "\t\t\t\t\t".'<ul>'."\n";
 
        // query q me ejecuta el submenu filtrando por usuario y para buscar el submenu segun el id que traigo
         $query = $this->ci->db->query("select *  from app_navmenu where idparent =".$id);
 
         foreach ($query->result() as $row)
            {
                $id = $row->id;
                $name = $row->name;
                $route = $row->route;
                $idparent = $row->idparent;
                $isdefault = $row->isdefault;
 
                $has_subcats = TRUE;
 

                $html_out2 .= '<li><a href="'.$route.'">'.$name.'</a></li>';
 
                
 
                // Recurse call to get more child submenus. <li><a href="#">Action</a></li>
                //   $html_out .= $this->get_childs($id);
            }
       
 
        return ($has_subcats) ? $html_out2 : FALSE; //($has_subcats) ? $html_out : FALSE;
 
    }
}
 
// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.
// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */
?>
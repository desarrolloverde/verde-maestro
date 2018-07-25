<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-default">
        <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php if(!empty($_SESSION['is_logged_in'])): ?>
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bienvenido<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>                        
                            <li><a href="<?php echo base_url(); ?>index.php/logout">Salir</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                        <li><a href="<?php echo base_url(); ?>index.php/usuario">Registrarse</a></li>
                        <li <?php if(isset($active) && $active == 'login'){ echo 'class="active"'; } ?> ><a href="<?php echo base_url(); ?>index.php/login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
</nav>
<div class="container">
    <?php
    if ($this->session->flashdata('mensaje_error') != NULL) {
        echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('mensaje_error') . '</div>';
    }

    if ($this->session->flashdata('mensaje_exito') != NULL) {
        echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('mensaje_exito') . '</div>';
    }
    ?>
</div>


<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Home</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#1">Link <span class="sr-only">(current)</span></a></li>
                <?php echo $this->dynamic_menu->build_menu(1);
                ?>
                <!--li><a href="#2">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown 1<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(!empty($_SESSION['is_logged_in'])): ?>
                <li><a href="<?php echo base_url(); ?>index.php/modulos">Administrar</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bienvenido <?php echo $_SESSION['user_email']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>index.php/logout">Salir</a></li>
                    </ul>
                </li>
                <?php else: ?>
                    <li><a href="#">Registrarse</a></li>
                    <li <?php if(isset($active) && $active == 'login'){ echo 'class="active"'; } ?> ><a href="<?php echo base_url(); ?>index.php/login">Login</a></li>
                <?php endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
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

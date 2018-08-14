<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title; ?></title>
<!-- SOLO PARA HACER FUNCIONAR AL CAROUSEL -->
    <?php if (!isset($_SESSION['sess'])) {?>
        <!-- Compiled  jquery JavaScript -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.js"></script>
        <!-- Compiled and minified Bootstrap JavaScript -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" ></script>
    <!--prueba con jquery-->
    <!--link href="<?php echo base_url(); ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.js" rel="stylesheet"-->
    <?php } ?>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
     <style>
		/* Center the avatar image inside this container */
			.imgcontainer {
			    text-align: center;
			    margin: 24px 0 12px 0;
			}   
			img.avatar {
			    width: 85%;
			    border-radius: 10%;
			}
			
			.container {
			    padding: 15px;
			}  
     </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
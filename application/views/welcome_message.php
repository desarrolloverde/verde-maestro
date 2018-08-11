<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container" id="container">
	<div class="col-md-6 center-block no-float">
		<div class="panel panel-success">
			<div class="panel-heading" align="center">
				<h3>Bienvenido al sistema VerumCard Sr(a).<?php echo $_SESSION['user_name'] ?></h3>
			</div>
			<div id="panel-body">
				<p>Su ultima Entrada al sistema fue <STRONG>Hoy</STRONG><?php //echo $ultima_sesion ?>.</p>
				<p>Tiene en proceso 1 transacciones <?php //echo $ultima_sesion ?>.</p>
			</div>
		</div>	
	</div>	
</div>

</body>
</html>
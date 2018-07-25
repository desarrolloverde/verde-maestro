<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container" id="container">
	<div class="col-md-6 center-block no-float">
		<div class="panel panel-primary">
			<div class="panel-heading" align="center-block">
				<h1 align="center-block"><?php echo $panel_title; ?></h1>
			</div>
			<div id="panel-body">
			<table class="table table-bordered">
						<thead>
						<tr>
  							<th>#</th><th>NOMBRE</th><th>RUTA</th><th>OPCIONES</th>
  						</tr>
  						</thead>
  						<tbody>
			<?php // print_r($modulos); 
			foreach ($modulos as $row) {
				echo "<tr><td>$row->id</td><td>$row->name</td><td>$row->route</td><td>EDITAR</td></tr>";
			}
			?>  						
  						</tbody>
				</table>				
			</div>
		</div>	
	</div>	
</div>

</body>
</html>
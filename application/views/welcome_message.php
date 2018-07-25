<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container" id="container">
	<div class="col-md-6 center-block no-float">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h1>Welcome to CodeIgniter!</h1>
			</div>
			<div id="panel-body">
				<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

				<p>If you would like to edit this page you'll find it located at:</p>
				<code>application/views/welcome_message.php</code>

				<p>The corresponding controller for this page is found at:</p>
				<code>application/controllers/Welcome.php</code>

				<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
			</div>

			<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
		</div>	
	</div>	
</div>

</body>
</html>
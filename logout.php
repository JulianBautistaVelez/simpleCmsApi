<?php
	require_once('./includes/clase_css_dinamico.php');
	require_once('./includes/clase_login.php');
	include("cabecera.php");
	include("footer.php");
	session_start();
	global $login;
	if(!empty($_POST)){$login->log_out($_POST);}
	//print_r($_SESSION);
	
 ?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <title>Prueba de CMS JULIÁN BAUTISTA</title>
  <meta charset="utf-8"/>
  <?php global $css; $css->dame_css(); ?>
  
 </head>
 <body>
	 
	<?php cabecera_bootstrap();?>
	<div class="centered">
		<?php
				 echo "
					 <form method='post'>
					 <input type='hidden' name='relleno' value='no_procede'>
					 <p><input type='submit' value='log out'/></p>
					 </form>";
			   
		 ?>
	</div>
	<?php
	footer();
	?>
 </body>
</html>

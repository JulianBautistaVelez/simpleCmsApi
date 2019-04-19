
<?php
	require_once('./includes/clase_css_dinamico.php');
	require_once('./includes/clase_consulta.php');
	include("cabecera.php");
	session_start();
	
	
 ?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <title>Prueba de CMS JULIÁN BAUTISTA</title>
  <meta charset="utf-8"/>
  <?php global $css; $css->dame_css(); ?>
  
 </head>
 <body>
	 
	<?php cabecera();?>
	<div class="centered">
		 ELIMINANDO POST :(
	</div>
	<?php 
		if(!empty($_GET)){
			if(isset($_GET['e'])){
				$id_post = $_GET['e'];	
				if($_SESSION["autentificado"]) {
					global $query;
					global $id_post;
					$query->elimina_post($id_post);
					header('Location: index.php');
				}
			} 
		}
	?>
 </body>
</html>








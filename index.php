<?php
	session_start();
	require_once('./includes/clase_consulta.php');
	require_once('./includes/clase_css_dinamico.php');
	require_once('./includes/clase_buscador.php');
	include("cabecera.php");
	global $query;
	global $buscador;
	if(!empty($_GET)){
		if(isset($_GET['p'])) $post = $_GET['p'];
		if(isset($_GET['c'])) $cat = $_GET['c'];
			
	}
	$configuracion = $query->config_blog();
	if(!isset($configuracion)){header('Location: configuracion.php');}
	$configuracion = $configuracion[0];  
	if(empty($post)&&empty($cat)){
		$post_array = $query->posts();
	} elseif(!empty($post)){
		$post_array = $query->post_id($post);
	} elseif(!empty($cat)){
		$post_array = $query->post_cat($cat);
	}
	
	if(!empty($_POST)){$post_array = $buscador->busca($_POST,"post");}
	
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
	 
		<?php cabecera();?>
	 
	 <div class="buscador"><form method="post"> <input type="text" name="busqueda"/> <input type='submit' value='buscar'/></form></div>
	 <div class="margin">
		 
		 <?php 
		 if(count($post_array)<1) {
			      echo "Bienvenido al blog ".$configuracion->nombre;}
			else foreach($post_array as $post):?>
			 <div class="border" >
				 
				 <div class="padding">
					<div class="content">
					<a href="?p=<?php echo $post->id; ?>"><h1 class="titulopost"><?php echo $post->titulo;?></h1></a>		
					<?php 
					//
						if(strlen($post->imagen)>1 && strlen($post->texto)>1){
							echo "<div class='textpost'><p>".$post->texto."</p></div>
							<img class='postimage' src='".$post->imagen."' alt='la imagen no ha podido ser cargada'>";
						}
						else if (strlen($post->texto)<=1 && strlen($post->imagen)>1) 
							echo "<div align='center' ><img class='media' src='".$post->imagen."' alt='la imagen no ha podido ser cargada'></div>";
						else if(strlen($post->texto)>1)
							echo "<p>".$post->texto."</p>";
						
					?>	
					
					
					<?php if($_SESSION["autentificado"]) {?>
					<a href="edit_post.php?p=<?php echo $post->id; ?>">editar </a>	|
					<a href="post_eliminado.php?e=<?php echo $post->id; ?>">eliminar </a>	
					<?php } ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div> 
 </body>
</html>


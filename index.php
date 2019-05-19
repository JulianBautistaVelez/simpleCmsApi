<?php

	//Modificada para usar bootstrap css
	session_start();
	require_once('./includes/clase_consulta.php');
	require_once('./includes/clase_css_dinamico.php');
	require_once('./includes/clase_buscador.php');
	include("cabecera.php");
	include("footer.php");
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
	 <div class="container-fluid">
		 <?php cabecera_bootstrap();?>
		 
		 <div class="buscador"><form method="post"> <input type="text" name="busqueda"/> <input type='submit' value='buscar'/></form></div>
		 
			 
			 <?php 
				if(count($post_array)<1) {
					  echo "Bienvenido al blog ".$configuracion->nombre;}
				else foreach($post_array as $post):?>
				
				<div class="row ">
					<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 ">
					
						<div class="content mb-5">
							
							<div class="row">		
								<div class="col-md-12">
									<a href="?p=<?php echo $post->id; ?>"><h1 class="text-center"><?php echo $post->titulo;?></h1></a>
								</div>
							</div>
							
							<div class="row">
								
								<?php 
								//
								
									if(strlen($post->imagen)>1 && strlen($post->texto)>1){
										echo "
										<div class='col-sm-12'>
											<p class='text-center'>".$post->texto."</p>
										</div>
										<div class='col-sm-8 offset-sm-2'>
											<img class='img-fluid' alt='Responsive image' src='".$post->imagen."' alt='la imagen no ha podido ser cargada'>
										</div>
										";
									}
									else if (strlen($post->texto)<=1 && strlen($post->imagen)>1) 
										echo "
											<div class='col-sm-8 offset-sm-2' >
												<img class='img-fluid'  src='".$post->imagen."' alt='la imagen no ha podido ser cargada'>
											</div>";
									else if(strlen($post->texto)>1)
										echo "<p>".$post->texto."</p>";
									
								?>	
							</div>
								
							<?php if($_SESSION["autentificado"]) {?>
							<div class="col-sm-4 offset-sm-4 ">
								<p class="text-center">
									<a class="text-success" href="edit_post.php?p=<?php echo $post->id; ?>">editar </a>	|
									<a class="text-danger" href="post_eliminado.php?e=<?php echo $post->id; ?>">eliminar </a>
								</p>
							</div>
							<?php } ?>
							
						</div>
						
					</div>
				</div>
			<?php endforeach ?>

		<?php footer(); ?>
	</div>
 </body>
</html>


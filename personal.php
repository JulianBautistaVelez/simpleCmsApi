<?php
	session_start();
	require_once('./includes/clase_consulta.php');
	require_once('./includes/clase_css_dinamico.php');
	require_once('./includes/clase_buscador.php');
	include("cabecera.php");
	include("footer.php");
	global $query;
	global $buscador;
	if(!empty($_GET)){
		if(isset($_GET['p'])) $personal = $_GET['p'];
		if(isset($_GET['e'])) $equipo = $_GET['e'];
			
	}
	$configuracion = $query->config_blog();
	if(!isset($configuracion)){header('Location: configuracion.php');}
	$configuracion = $configuracion[0];  
	if(empty($personal)&&empty($equipo)){
		$personal_array = $query->personal_completo();
	}elseif(!empty($equipo)){
		$personal_array = $query->personal_equipo($equipo);
	}elseif(!empty($personal)){
		$personal_array = $query->id_persona($personal);
	}
	
	if(!empty($_POST)){$personal_array = $buscador->busqueda($_POST,"persona");}
	
	//print_r($personal_array);
	
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
	 
	 <div class="buscador"><form method="post"> <input type="text" name="busqueda"/> <input type='submit' value='buscar'/></form></div>
	 <div class="container">
		 
		 <?php 
		 if(count($personal_array)<1) {
			      echo "Bienvenido al blog, todavia no hay entradas para el personal del club ".$configuracion->nombre;}
			else foreach($personal_array as $persona):?>
			 <div class="row" >
				 
				 <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">
					<div class="content mb-5">
						
					<a href="?p=<?php echo $persona->id; ?>"><h1 class="titulopost"><?php echo $persona->nombre;?></h1></a>		
					<?php 
					//
						if(strlen($persona->foto)>1 && strlen($persona->descripcion)>1){
							echo "
							<div class='row'>
							<div class='col-sm-6'><p>".$persona->descripcion."</p>
														<p>Apodo: ".$persona->apodo."</p>
														<p>Posicion: ".$persona->posicion."</p>
														<p>Número de camiseta: ".$persona->camiseta."</p>
														<p>Altura: ".$persona->altura." centimetros</p>
														<p>Peso: ".$persona->peso." kilogramos</p>
														<p>Deporte: ".$persona->deporte."</p>
														<p>Equipo: ".$persona->equipo."</p>
								  
							</div>
							<div class='col-sm-5'>
							<img class='img-fluid' src='".$persona->foto."' alt='la imagen no ha podido ser cargada'>
							</div>
							</div>";
						}
						else if (strlen($persona->descripcion)<=1 && strlen($persona->imagen)>1) 
							echo "<div class='col-sm-12' ><img class='img-fluid' src='".$persona->foto."' alt='la imagen no ha podido ser cargada'></div>";
						else if(strlen($persona->descripcion)>1)
							echo "<p>".$persona->descripcion."</p>";
						
					?>	
					
					
					<?php if($_SESSION["autentificado"]) {?>
					<div class="col-sm-4 offset-sm-4 ">
						<p class="text-center">
							<a class="text-success" href="edit_personal.php?p=<?php echo $persona->id; ?>">editar </a>	|
							<a class="text-danger" href=".php?e=<?php echo $persona->id; ?>">eliminar </a>
						</p>
					</div>
						
					<?php } ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div> 
	<?php
	footer();
	?>
 </body>
</html>


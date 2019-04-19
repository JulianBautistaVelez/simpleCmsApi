<?php
	session_start();
	require_once('./includes/clase_consulta.php');
	require_once('./includes/clase_css_dinamico.php');
	require_once('./includes/clase_buscador.php');
	include("cabecera.php");
	global $query;
	global $buscador;
	if(!empty($_GET)){
		if(isset($_GET['e'])) $equipo = $_GET['e'];
			
	}
	$configuracion = $query->config_blog();
	if(!isset($configuracion)){header('Location: configuracion.php');}
	$configuracion = $configuracion[0];  
	if(empty($equipo)){
		$equipos_array = $query->equipos_completo();
	} elseif(!empty($equipo)){
		$equipos_array = $query->id_equipo($equipo);
	}
	
	if(!empty($_POST)){$equipos_array = $buscador->busqueda($_POST,"equipo");}
	
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
	 
		<?php cabecera();?>
	 
	 <div class="buscador"><form method="post"> <input type="text" name="busqueda"/> <input type='submit' value='buscar'/></form></div>
	 <div class="margin">
		 
		 <?php 
		 if(count($equipos_array)<1) {
			      echo "Bienvenido al blog, todavia no hay entradas para el personal del club ".$configuracion->nombre;}
			else foreach($equipos_array as $equipo):?>
			 <div class="border" >
				 
				 <div class="padding">
					<div class="content">
					<a href="?p=<?php echo $equipo->id; ?>"><h1 class="titulopost"><?php echo $equipo->nombre;?></h1></a>		
					<?php 
					//
						if(strlen($equipo->escudo)>1 && strlen($equipo->descripcion)>1){
							echo "<div class='textpost'><p>".$equipo->descripcion."</p>
														<p>Deporte: ".$equipo->deporte."</p>
													
								  </div>
							<img class='postimage' src='".$equipo->escudo."' alt='la imagen no ha podido ser cargada'>";
						}
						else if (strlen($equipo->descripcion)<=1 && strlen($equipo->escudo)>1) 
							echo "<div align='center' ><img class='media' src='".$equipo->escudo."' alt='la imagen no ha podido ser cargada'></div>";
						else if(strlen($equipo->descripcion)>1)
							echo "<p>".$equipo->descripcion."</p>";
						
						
					?>	
					
					<p><a href="personal.php?e=<?php echo $equipo->nombre; ?>">Plantilla</a></p>
					<?php if($_SESSION["autentificado"]) {?>
					<a href="edit_equipo.php?id_eq=<?php echo $equipo->id; ?>">editar </a>	|
					<a href=".php?e=<?php echo $equipo->id; ?>">eliminar </a>	
					<?php } ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div> 
 </body>
</html>


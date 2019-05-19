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
	 
		<?php cabecera_bootstrap();?>
	 
	 <div class="buscador"><form method="post"> <input type="text" name="busqueda"/> <input type='submit' value='buscar'/></form></div>
	 <div class="container">
		 
		 <?php 
		 if(count($equipos_array)<1) {
			      echo "Bienvenido al blog, todavia no hay entradas para el personal del club ".$configuracion->nombre;}
			else foreach($equipos_array as $equipo):?>
			 <div class="row" >
				 
				 <div class="col-sm-10 offset-sm-2 col-md-8 offset-md-2">
					<div class="content mb-5">
						<div class="col-sm-12">
							<a href="?p=<?php echo $equipo->id; ?>"><h1 class="titulopost"><?php echo $equipo->nombre;?></h1></a>
						</div>
							
					<?php 
					//
						if(strlen($equipo->escudo)>1 && strlen($equipo->descripcion)>1){
							echo "<div class='row'>
									<div class='col-md-4'><p>".$equipo->descripcion."</p>
														<p>Deporte: ".$equipo->deporte."</p>
														<p><a href='personal.php?e=".$equipo->nombre."'>Plantilla</a></p>			
								  </div>
								  
								  <div class='col-md-7'>
										<img class='img-fluid' src='".$equipo->escudo."' alt='la imagen no ha podido ser cargada'>
									</div>
								  </div>";
							
						}
						else if (strlen($equipo->descripcion)<=1 && strlen($equipo->escudo)>1) 
							echo "<div class='row'>
									<div class='col-sm-12' >
										<img class='img-fluid' src='".$equipo->escudo."' alt='la imagen no ha podido ser cargada'>
									</div>
								</div>";
						else if(strlen($equipo->descripcion)>1)
							echo "<div class='row'>
									<div class='col-sm-12' >
										<p>".$equipo->descripcion."</p>
									</div>
								  </div>";
						
						
					?>	
					
					
					<?php if($_SESSION["autentificado"]) {?>
						<div class="col-sm-4 offset-sm-4 ">
							<p class="text-center">
								<a class="text-success" href="edit_personal.p<a class="text-success" href="edit_equipo.php?id_eq=<?php echo $equipo->id; ?>">editar </a>	|
								<a class="text-danger" href=".php?e=<?php echo $equipo->id; ?>">eliminar </a>	
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


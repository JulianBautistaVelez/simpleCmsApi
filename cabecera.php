<?php 
require_once('./includes/clase_consulta.php');
global $query;
$configuracion = $query->config_blog();
$configuracion = $configuracion[0];
//print_r($configuracion);

function cabecera_bootstrap(){
	global $configuracion;
	if(!isset($configuracion)){
		$nombre_blog = "Pantalla de configuración"	;
	} else {$nombre_blog =$configuracion->nombre;}
	
	echo "
	
	<div class='page-header'>
	
				<nav class='masthead navbar navbar-expand-lg navbar-light bg-light'>
				  <a class='navbar-brand' href='index.php'>".$nombre_blog."</a>
				  <a class='navbar-brand' href='index.php'>
					<img src='".$configuracion->logo."' width='60' height='60' alt=''>
				  </a>
				  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='' aria-controls='barra_navegacion' aria-expanded='false' aria-label='Toggle navigation'>
					<span class='navbar-toggler-icon'></span>
				  </button>

				  <div class='collapse navbar-collapse' id='barra_navegacion'>
					<ul class='navbar-nav mr-auto'>
					  
					  <li class='nav-item dropdown'>
						<a class='nav-link dropdown-toggle' href='#' id='mavBarContenidos' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						  Contenidos
						</a>
						<div class='dropdown-menu' aria-labelledby='mavBarContenidos'>
						  <a class='dropdown-item' href='index.php'>Noticias y media</a>
						  <a class='dropdown-item' href='personal.php'>personal</a>
						  <a class='dropdown-item' href='equipos.php'>equipos</a>
						</div>
					  </li>
					  
					  <li class='nav-item dropdown'>
						<a class='nav-link dropdown-toggle' href='#' id='NavBarInsertar' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						  Insertar
						</a>
						<div class='dropdown-menu' aria-labelledby='NavBarInsertar'>
						  <a class='dropdown-item' href='edit_post.php'>Insertar post</a>
						  <a class='dropdown-item' href='edit_equipo.php'>Insertar equipo</a>
						  <a class='dropdown-item' href='edit_personal.php'>Insertar miembro de plantilla</a>
						</div>
					  </li>";
					  
					  if($_SESSION['autentificado']) {
												echo "
														<li class='nav-item'>
														<a class='nav-link' href='configuracion.php'>Configuración</a>
														</li>
														<li class='nav-item'>
														<a class='nav-link' href='logout.php' >Log out </a>
													  </li>
													  <li class='nav-item'>
														<a class='nav-link' href='inscribir.php'>Inscribir a servicio web</a>
													  </li>"
												;}
					  else echo "<li class='nav-item'><a href='login.php' >Log in </a></li>";
					echo "
					</ul>
				  </div>
				</nav>
		</div>
	";
	
	
}
?>



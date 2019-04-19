<?php 
require_once('./includes/clase_consulta.php');
global $query;
$configuracion = $query->config_blog();
$configuracion = $configuracion[0];
//print_r($configuracion);
function cabecera(){
	global $configuracion;
	if(!isset($configuracion)){
		$nombre_blog = "Pantalla de configuración"	;
	} else {$nombre_blog =$configuracion->nombre;}
	
		echo "
		 <div class='page-header'>
			 <div class='masthead'>
				<a href='index.php'><h1 class='page-header h1'>".$nombre_blog."</h1></a> 
				
				<contenedor_menu >

						<ul class='nav'>
							<li><a href='index.php' >Contenidos </a>
								<ul>
									<li class='desplegable'><a href='index.php'>Noticias y media </a></li>
									<li class='desplegable'><a href='personal.php'>Personal </a></li>
									<li class='desplegable'><a href='equipos.php'>equipos </a></li>
								</ul>
							</li>
							
							<li><a href=''>Insertar contenido </a>
								<ul>
									<li class='desplegable'><a href='edit_post.php'>Insertar post </a></li>
									<li class='desplegable'><a href='edit_equipo.php'>Insertar equipo </a></li>
									<li class='desplegable'><a href='edit_personal.php'>Insertar miembro de plantilla </a></li>
								</ul>
							</li>
							
							<li><a href='configuracion.php' >Configuración </a></li>";
							if($_SESSION['autentificado']) {
								echo "<li><a href='logout.php' >Log out </a></li>
									  <li><a href='inscribir.php'>Inscribir a servicio web</a></li>"
								;}
							else echo "<li><a href='login.php' >Log in </a></li>";
							
							echo "
						</ul>
				</contenedor_menu>
				<a href='index.php'><img class='logo' src='".$configuracion->logo. "' alt='No se ha podido cargar la imagen'/></a>
			 </div>
		 </div>
	";
}
?>

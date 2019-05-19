<?php
	
	error_reporting(E_ALL);
	ini_set('display_errors',1);
	
	require_once('includes/clase_consulta_servicio.php');
	require_once('includes/clase_buscador_servicio.php');
	require_once('includes/clase_bd_servicio.php');
	global $query;
	global $buscador;
	global $bd;

	if(isset($_GET['consulta_clubes'])){
		clubes();		
	}
	
	else if(isset($_GET['conecta_club'])){
		$club_id = $_GET['conecta_club'];
		crea_segunda_conexion($club_id);
		noticias_club("noticias","ninguno");
	}
	
	else if(isset($_GET['media_club'])){
			$club_id = $_GET['media_club'];
			crea_segunda_conexion($club_id);
			noticias_club("media","ninguno");
		}
	
	else if(isset($_GET['consulta_equipos'])){
			$club_id = $_GET['consulta_equipos'];
			crea_segunda_conexion($club_id);
			equipos_club();
		}
		
	else if(isset($_GET['noticias_equipo'])){
			$club_id = $_GET['club'];
			crea_segunda_conexion($club_id);
			$equipo_id = $_GET['noticias_equipo'];
			noticias_club("noticias",$equipo_id);
		}
		
	else if(isset($_GET['media_equipo'])){
			$club_id = $_GET['club'];
			crea_segunda_conexion($club_id);
			$equipo_id = $_GET['media_equipo'];
			noticias_club("media",$equipo_id);
		}

	else if(isset($_GET['plantilla_equipo'])){
			$club_id = $_GET['club'];
			crea_segunda_conexion($club_id);
			$equipo_id = $_GET['plantilla_equipo'];
			plantillas_equipos_club($equipo_id);
		}

	else if(isset($_GET['media_jugador'])){
			$club_id = $_GET['club'];
			crea_segunda_conexion($club_id);
			$nombre_jugador = $_GET['media_jugador'];
			media_jugador($nombre_jugador);
		}

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		/*SI SE VA A INSERTAR UN EQUIPO EN EL SERVICIO WEB*/
		if(isset($_POST['nombre'])) {
			
			//echo "<script>alert('aqui llegamos')</script>";
			$club->nombre = $_POST['nombre'];
			$club->escudo = $_POST['escudo'];  //AQUI SE GUARDARA UNA URL DE LA IMAGEN
			$club->direccion_bd = $_POST['direccion_bd'];
			$club->nombre_bd = $_POST['nombre_bd'];
			$club->contrasenya = $_POST['contrasenya'];
			$club->usuario = $_POST['usuario'];
			
			//echo print_r($club);
			$inscrito_ant = $query->club_nombre($club);
			
			if(count($inscrito_ant)<1){ //si no hay ningun cms con el nombre del club a inscribir			
				if(registrar_club($club)){
					//registrar_club($club);
					header('Content-type: text/html');
					echo "inscrito en el servicio web con el nombre ".$club->nombre;
				}
				else {header('Content-type: text/html');
					  echo "No se ha podido incribir en el servicio web";
				}
			}
			else {if(modificar_registro($club)){
					header('Content-type: text/html');
					echo "Registro modificado en el servicio web ".$club->nombre;
				}
				else {header('Content-type: text/html');
					  echo "No se ha podido modificar el registro";
				}
			
			}
		}
		
		if(isset($_POST['consulta_clubes'])){
			//regresa_bd_inicial();
			clubes();		
		}
		
		if(isset($_POST['conecta_club'])){
			$club_id = $_POST['conecta_club'];
			crea_segunda_conexion($club_id);	
			noticias_club("noticias","ninguno");
		}
		
		if(isset($_POST['consulta_equipos'])){
			$club_id = $_POST['consulta_equipos'];
			crea_segunda_conexion($club_id);
			equipos_club();
		}
		
		if(isset($_POST['media_club'])){
			$club_id = $_POST['media_club'];
			crea_segunda_conexion($club_id);
			noticias_club("media","ninguno");
		}
		
		if(isset($_POST['noticias_equipo'])){
			$club_id = $_POST['club'];
			crea_segunda_conexion($club_id);
			$equipo_id = $_POST['noticias_equipo'];
			noticias_club("noticias",$equipo_id);
		}
		
		if(isset($_POST['media_equipo'])){
			$club_id = $_POST['club'];
			crea_segunda_conexion($club_id);
			$equipo_id = $_POST['media_equipo'];
			noticias_club("media",$equipo_id);
		}

		else if(isset($_POST['plantilla_equipo'])){
			$club_id = $_POST['club'];
			crea_segunda_conexion($club_id);
			$equipo_id = $_POST['plantilla_equipo'];
			plantillas_equipos_club($equipo_id);
		}

		else if(isset($_POST['media_jugador'])){
			$club_id = $_POST['club'];
			crea_segunda_conexion($club_id);
			$nombre_jugador = $_POST['media_jugador'];
			media_jugador($nombre_jugador);
		}
	}


	function crea_segunda_conexion($club_id){
		global $bd;
		$enlace = datos_conexion_club($club_id);
		$enlace = $enlace[0];
		$resultado = $bd->crea_segunda_conexion($enlace);
	}
	
	/*FUNCION PARA REGISTRAR CLUBES (cms) EN LA BASE DE DATOS DEL SERVICIO WEB*/
	function registrar_club($club){
		global $query;
		return $query->inserta_club($club);
	}
	/*FUNCION PARA REGISTRAR CLUBES (cms) EN LA BASE DE DATOS DEL SERVICIO WEB*/
	function modificar_registro($club){
		global $query;
		return $query->modifica_club($club);
	}
	/*FUNCION PARA RECUPERAR DE LA BASE DE DATOS LOS CLUBES Y LA INFO DE SUS BDs */
	function clubes(){
		global $query;
		$datos = $query->clubes_inscritos();
		formatea_envia($datos);	
	}
	/*FUNCION PARA CONECTARSE A LAS BDs DE LOS CLUBES PARA EMPEZAR A RECOPILAR INFORMACION ESPECIFICA DE LOS MISMOS*/
	function cambiar_club($enlace){
		global $bd;
		$bd->crea_segunda_conexion($enlace);
	}
	/*FUNCION PARA RECOGER LOS DATOS DE CONEXION A LA BD DE UN CLUB ESPECIFICO*/
	function datos_conexion_club($id){
		global $query;
		$enlace = $query->conexion_club($id);
		return $enlace;
	}
	
	/*TODAS ESTAS CONSULTAS SE REALIZARAN SOBRE LA BD DE UN CLUB ESPECIFICO AL QUE ACTUALMENTE 
	 * ESTE CONECTADO AL SERVICIO WEB*/
	/*FUNCION PARA RECUPERAR LOS DATOS DE CONFIGURACION ESTETICA DE LOS CMS DE LOS CLUBES*/
	function configuracion_club(){
		global $query;
		$datos=$query->config_blog();
		formatea_envia($datos);
	}
	/*FUNCION PARA RECUPERAR LAS NOTICIAS Y FOTOS DE LOS CLUBES QUE NO TIENEN NINGUN EQUIPO COMO REFERENCIA*/
	function noticias_club($categoria, $equipo){
		global $query;
		$datos=$query->post_cat_club($categoria, $equipo);
		formatea_envia($datos);
	}
	/*FUNCION PARA RECUPERAR LOS DATOS DE LOS EQUIPOS QUE POSEE UN CLUB*/
	function equipos_club(){
		global $query;
		$datos=$query->equipos_completo();
		formatea_envia($datos);
	}
	/*FUNCION PARA RECUPERAR LAS PLANTILLAS DE UN EQUIPO ESPECIFICO DEL CLUB*/
	function plantillas_equipos_club($equipo){
		global $query;
		$datos=$query->personal_equipo($equipo);
		formatea_envia($datos);
	}
	/*FUNCION PARA RECUPERAR LAS IMAGENES QUE TENGAN EN LA ETIQUETA ALGUNA PALABRA ESPECIFICA PASADA COMO PARAMETRO*/
	function media_jugador($nombre){
		global $query;
		$datos=$query->post_img_etiqueta("media",$nombre);
		formatea_envia($datos);
	}
	
	/*NO LO VOY A IMPLEMENTAR TODAVIA*/
	function buscador_(){
		global $buscador;
		
	}
	
	/*INCECESARIOOOO**************************************************************************/
	/*FUNCION PARA RECUPERAR LAS NOTICIAS EN EL CMS QUE REFERENCIAN A UN EQUIPO ESPECIFICO*/
	function noticias_equipo_club(){
		global $query;
		$datos=$query->config_blog();
		formatea_envia($datos);
	}
	/*FUNCION PARA RECUPERAR LAS FOTOS EN EL CMS QUE REFERENCIAN A UN EQUIPO ESPECIFICO*/
	function media_equipo_club(){
		global $query;
		$datos=$query->config_blog();
		formatea_envia($datos);
	}
	/*FUNCION PARA RECUPERAR LAS FOTOS DE LOS CMS QUE NO TIENEN NINGUN EQUIPO COMO REFERENCIA*/
	function media_club(){
		global $query;
		$datos=$query->config_blog();
		formatea_envia($datos);	
	}
	/*****************************************************************************************/
	
	/*HACE FALTA UNA FUNCION PARA LIMPIAR LA BASE DE DATOS DE CMS A LOS QUE NO SE PUEDE CONECTAR*/
	
	function formatea_envia($datos){
		header('Content-type: application/json');
		echo json_encode($datos);
	}
	
 ?>



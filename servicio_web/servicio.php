<?php
	/* TO SEARCH FOR FAILS IN THE CODE; THIS WILL ACTIVATE THE WARNINGS AND ERRORS TO BE DISPLAYED WHEN YOU ACCES THE PAGE*/
	//error_reporting(E_ALL);
	//ini_set('display_errors',1);
	
	require_once('includes/clase_consulta_servicio.php');
	require_once('includes/clase_buscador_servicio.php');
	require_once('includes/clase_bd_servicio.php');
	global $query;
	global $buscador;
	global $bd;

	/***************************REQUEST MADE BY GET METHOD***************************************************************/
	/********************************************************************************************************************/

	/*return the organizations subscribed to the web service (those who want to be accessible from the mobile app)*/
	if(isset($_GET['consulta_clubes'])){
		clubes();		
	}
	
	/*return the news posted by the organization with no team especifically related in the blog the user has entered into*/
	else if(isset($_GET['conecta_club'])){
		$club_id = $_GET['conecta_club'];
		crea_segunda_conexion($club_id);
		noticias_club("noticias","ninguno");
	}
	
	/*return the media post uploaded by the organization with no team especifically related in the blog the user has entered into*/
	else if(isset($_GET['media_club'])){
			$club_id = $_GET['media_club'];
			crea_segunda_conexion($club_id);
			noticias_club("media","ninguno");
		}
	
	/*this function will return the teams that the organization have*/
	else if(isset($_GET['consulta_equipos'])){
			$club_id = $_GET['consulta_equipos'];
			crea_segunda_conexion($club_id);
			equipos_club();
		}
	
	/*this function will return the news related to the team the user has entered into*/
	else if(isset($_GET['noticias_equipo'])){
			$club_id = $_GET['club'];
			crea_segunda_conexion($club_id);
			$equipo_id = $_GET['noticias_equipo'];
			noticias_club("noticias",$equipo_id);
		}
		
	/*return the media post related to the team the user has entered into*/
	else if(isset($_GET['media_equipo'])){
			$club_id = $_GET['club'];
			crea_segunda_conexion($club_id);
			$equipo_id = $_GET['media_equipo'];
			noticias_club("media",$equipo_id);
		}
	
	/*return the players of the team the user is navigating throught*/
	else if(isset($_GET['plantilla_equipo'])){
			$club_id = $_GET['club'];
			crea_segunda_conexion($club_id);
			$equipo_id = $_GET['plantilla_equipo'];
			plantillas_equipos_club($equipo_id);
		}

	/*return the media post of the player the user is watching*/
	else if(isset($_GET['media_jugador'])){
			$club_id = $_GET['club'];
			crea_segunda_conexion($club_id);
			$nombre_jugador = $_GET['media_jugador'];
			media_jugador($nombre_jugador);
		}

	
	/********************************FROM NOW ON THE SERVICE HANDLE THE REQUEST MADE BY POST METHOD**************/
	/************************************************************************************************************/
	/*here the service handle when an organization is subscribing to it*/
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		/*SI SE VA A INSERTAR UN EQUIPO EN EL SERVICIO WEB*/
		if(isset($_POST['nombre'])) {
			
			$club->nombre = $_POST['nombre'];
			$club->escudo = $_POST['escudo'];  //guarda una url de la imagen del escudo //it saves an URL of the image uploaded 
			$club->direccion_bd = $_POST['direccion_bd'];
			$club->nombre_bd = $_POST['nombre_bd'];
			$club->contrasenya = $_POST['contrasenya']; //password for the DB of the organization
			$club->usuario = $_POST['usuario']; //usser for the DB of the organization
			
			$inscrito_ant = $query->club_nombre($club);
			
			//here the web service check there is no other organization with the same name (there can`t be two at the same time with the same name)
			if(count($inscrito_ant)<1){ //si no hay ningun cms con el nombre del club a inscribir	
				if(registrar_club($club)){
					header('Content-type: text/html');
					echo "inscrito en el servicio web con el nombre ".$club->nombre;
				}
				else {header('Content-type: text/html');
					  echo "No se ha podido incribir en el servicio web";
				}
			}
			//you can change the registry values for your organization
			else {if(modificar_registro($club)){
					header('Content-type: text/html');
					echo "Registro modificado en el servicio web ".$club->nombre;
				}
				else {header('Content-type: text/html');
					  echo "No se ha podido modificar el registro";
				}
			
			}
		}
		
		
		/*return the organizations subscribed to the web service (those who want to be accessible from the mobile app)*/
		if(isset($_POST['consulta_clubes'])){
			clubes();		
		}
		
		/*return the news posted by the organization with no team especifically related in the blog  the user has entered into*/
		if(isset($_POST['conecta_club'])){
			$club_id = $_POST['conecta_club'];
			crea_segunda_conexion($club_id);	
			noticias_club("noticias","ninguno");
		}
		
		/*this function will return the teams that the organization have*/
		if(isset($_POST['consulta_equipos'])){
			$club_id = $_POST['consulta_equipos'];
			crea_segunda_conexion($club_id);
			equipos_club();
		}
		
		
		/*return the media post uploaded by the organization with no team especifically related in the blog the user has entered into*/
		if(isset($_POST['media_club'])){
			$club_id = $_POST['media_club'];
			crea_segunda_conexion($club_id);
			noticias_club("media","ninguno");
		}
		
		/*this function will return the news related to the team the user has entered into*/
		if(isset($_POST['noticias_equipo'])){
			$club_id = $_POST['club'];
			crea_segunda_conexion($club_id);
			$equipo_id = $_POST['noticias_equipo'];
			noticias_club("noticias",$equipo_id);
		}
		
		/*return the media post related to the team the user has entered into*/
		if(isset($_POST['media_equipo'])){
			$club_id = $_POST['club'];
			crea_segunda_conexion($club_id);
			$equipo_id = $_POST['media_equipo'];
			noticias_club("media",$equipo_id);
		}
		
		/*return the players of the team the user is navigating throught*/
		else if(isset($_POST['plantilla_equipo'])){
			$club_id = $_POST['club'];
			crea_segunda_conexion($club_id);
			$equipo_id = $_POST['plantilla_equipo'];
			plantillas_equipos_club($equipo_id);
		}
		
		/*return the media post of the player the user is watching*/
		else if(isset($_POST['media_jugador'])){
			$club_id = $_POST['club'];
			crea_segunda_conexion($club_id);
			$nombre_jugador = $_POST['media_jugador'];
			media_jugador($nombre_jugador);
		}
	}

	/***************HERE ARE THE FUNCTIONS THE WEB SERVICE WILL USE TO RESPOND TO THE GET OR POST REQUEST********************/
	/************************************************************************************************************************/

	/*the web service need two connections (one to it's own DB and another for the organization's DB)*/
	function crea_segunda_conexion($club_id){
		global $bd;
		$enlace = datos_conexion_club($club_id);
		$enlace = $enlace[0];
		$resultado = $bd->crea_segunda_conexion($enlace);
	}
	
	/*this function subscribes the organization into the web service*/
	/*FUNCION PARA REGISTRAR CLUBES (cms) EN LA BASE DE DATOS DEL SERVICIO WEB*/
	function registrar_club($club){
		global $query;
		return $query->inserta_club($club);
	}
	
	/*this function modify the organization's subscribing values in the web service*/
	/*FUNCION PARA REGISTRAR CLUBES (cms) EN LA BASE DE DATOS DEL SERVICIO WEB*/
	function modificar_registro($club){
		global $query;
		return $query->modifica_club($club);
	}
	
	/*return the organizations subscribed in the web service to the app users*/
	/*FUNCION PARA RECUPERAR DE LA BASE DE DATOS LOS CLUBES Y LA INFO DE SUS BDs */
	function clubes(){
		global $query;
		$datos = $query->clubes_inscritos();
		formatea_envia($datos);	
	}
	
	/*used when the app user want to navigate throught another organization's blog*/
	/*FUNCION PARA CONECTARSE A LAS BDs DE LOS CLUBES PARA EMPEZAR A RECOPILAR INFORMACION ESPECIFICA DE LOS MISMOS*/
	function cambiar_club($enlace){
		global $bd;
		$bd->crea_segunda_conexion($enlace);
	}

	/*it recieves the id of an organization and return the values for the connection o it's database*/
	/*FUNCION PARA RECOGER LOS DATOS DE CONEXION A LA BD DE UN CLUB ESPECIFICO*/
	function datos_conexion_club($id){
		global $query;
		$enlace = $query->conexion_club($id);
		return $enlace;
	}
	
	/************************** NOW ALL THIS FUNCTIONS WILL ACT ON A SINGLE ORGANIZATION'S BLOG************************/
	/************************** THE ONE TO WICH THE USER IS CONNECTED TO **********************************************/

	/*TODAS ESTAS CONSULTAS SE REALIZARAN SOBRE LA BD DE UN CLUB ESPECIFICO AL QUE ACTUALMENTE 
	 * ESTE CONECTADO AL SERVICIO WEB*/

	/*Since you can edit the color scheme of the blog here is the function to retrieve that information */
	/*FUNCION PARA RECUPERAR LOS DATOS DE CONFIGURACION ESTETICA DE LOS CMS DE LOS CLUBES*/
	function configuracion_club(){
		global $query;
		$datos=$query->config_blog();
		formatea_envia($datos);
	}
	
	/* this function recieves the type of post (NEWS OR MEDIA) the service needs and returns it*/ 
	/*FUNCION PARA RECUPERAR LAS NOTICIAS Y FOTOS */
	function noticias_club($categoria, $equipo){
		global $query;
		$datos=$query->post_cat_club($categoria, $equipo);
		formatea_envia($datos);
	}

	/*returns the teams in an organization*/
	/*FUNCION PARA RECUPERAR LOS DATOS DE LOS EQUIPOS QUE POSEE UN CLUB*/
	function equipos_club(){
		global $query;
		$datos=$query->equipos_completo();
		formatea_envia($datos);
	}

	/*returns the players of an specific team*/
	/*FUNCION PARA RECUPERAR LAS PLANTILLAS DE UN EQUIPO ESPECIFICO DEL CLUB*/
	function plantillas_equipos_club($equipo){
		global $query;
		$datos=$query->personal_equipo($equipo);
		formatea_envia($datos);
	}
	
	/*return the media of an specific player*/
	/*FUNCION PARA RECUPERAR LAS IMAGENES QUE TENGAN EN LA ETIQUETA ALGUNA PALABRA ESPECIFICA PASADA COMO PARAMETRO*/
	function media_jugador($nombre){
		global $query;
		$datos=$query->post_img_etiqueta("media",$nombre);
		formatea_envia($datos);
	}
	
	/*return the news of an specific team*/
	/*FUNCION PARA RECUPERAR LAS NOTICIAS EN EL CMS QUE REFERENCIAN A UN EQUIPO ESPECIFICO*/
	function noticias_equipo_club(){
		global $query;
		$datos=$query->config_blog();
		formatea_envia($datos);
	}

	/*return the pictures that belongs to a team*/
	/*FUNCION PARA RECUPERAR LAS FOTOS EN EL CMS QUE REFERENCIAN A UN EQUIPO ESPECIFICO*/
	function media_equipo_club(){
		global $query;
		$datos=$query->config_blog();
		formatea_envia($datos);
	}

	/*return the pictures that don't have an specific team*/
	/*FUNCION PARA RECUPERAR LAS FOTOS DE LOS CMS QUE NO TIENEN NINGUN EQUIPO COMO REFERENCIA*/
	function media_club(){
		global $query;
		$datos=$query->config_blog();
		formatea_envia($datos);	
	}
	/*****************************************************************************************/
	
	
	/*this function gives gives a json format to the data before it's send*/
	function formatea_envia($datos){
		header('Content-type: application/json');
		echo json_encode($datos);
	}
	
 ?>



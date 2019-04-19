<?php
	define("propia", true);
	define("ajena", false);
	require_once('clase_bd_servicio.php');
	
	if(!class_exists("clase_consulta")){
		class clase_consulta{
			
			
			public function posts(){
				global $bd;
				$consulta="SELECT * FROM post ORDER BY fecha DESC";
				return $bd->select($consulta,ajena);
			}
			public function post_id($id){
				global $bd;	
				$consulta="SELECT * FROM post WHERE ID = '".$id."'";
				return $bd->select($consulta,ajena);
			}
			public function post_cat($cat){
				global $bd;	
				$consulta="SELECT * FROM post WHERE categoria = '".$cat."'";
				return $bd->select($consulta,ajena);
			}
			/*RECUPERARA POST DE NOTICIAS Y MEDIA DE EQUIPOS O DEL CLUB SI EL PARAMETRO EQUIPO ES IGUAL A "ninguno"*/
			public function post_cat_club($cat, $equipo){
				global $bd;	
				$consulta="SELECT * FROM post WHERE categoria = '".$cat."' AND equipo = '".$equipo."'";
				return $bd->select($consulta,ajena);
			}
			
			public function post_img_etiqueta($cat, $equipo){
				global $bd;	
				$consulta="SELECT * FROM post WHERE categoria = '".$cat."' AND etiquetas LIKE '%".$equipo."%'";
				return $bd->select($consulta,ajena);
			}
			
			public function config_blog(){
				global $bd;	
				$consulta="SELECT * FROM blog ORDER BY fecha DESC LIMIT 1";
				return $bd->select($consulta,ajena);
			}
			
			public function busqueda($termino){
				global $bd;
				$consulta ="SELECT * FROM post WHERE titulo LIKE '%".$termino."%' UNION 
							SELECT * FROM post WHERE etiquetas LIKE '%".$termino."%' UNION 
							SELECT * FROM post WHERE texto LIKE '%".$termino."%'";
				return $bd->select($consulta,ajena);	
			}
			public function busqueda_equipo($termino){
				global $bd;
				$consulta ="SELECT * FROM post WHERE nombre LIKE '%".$termino."%' UNION 
							SELECT * FROM post WHERE descripcion LIKE '%".$termino."%' UNION 
							SELECT * FROM post WHERE deporte LIKE '%".$termino."%'";
				return $bd->select($consulta,ajena);	
			}
			public function busqueda_personal($termino){
				global $bd;
				$consulta ="SELECT * FROM persona WHERE nombre LIKE '%".$termino."%' UNION 
							SELECT * FROM persona WHERE etiquetas LIKE '%".$termino."%' UNION 
							SELECT * FROM persona WHERE descripcion LIKE '%".$termino."%' UNION 
							SELECT * FROM persona WHERE equipo LIKE '%".$termino."%'";
				return $bd->select($consulta,ajena);	
			}
			public function id_equipo($id){
				global $bd;
				$consulta ="SELECT * FROM equipo WHERE id ='".$id."'";
				return $bd->select($consulta,ajena);	
			}
			public function id_persona($id){
				global $bd;
				$consulta ="SELECT * FROM persona WHERE id ='".$id."'";
				return $bd->select($consulta,ajena);	
			}
			public function equipos(){
				global $bd;
				$consulta ="SELECT nombre, deporte FROM equipo";
				return $bd->select($consulta,ajena);	
			}
			public function equipos_completo(){
				global $bd;
				$consulta ="SELECT * FROM equipo ORDER BY id DESC";
				return $bd->select($consulta,ajena);	
			}
			public function personal_completo(){
				global $bd;
				$consulta ="SELECT * FROM persona";
				return $bd->select($consulta,ajena);	
			}
			public function personal_equipo($equipo){
				global $bd;
				$consulta ="SELECT * FROM persona WHERE equipo ='".$equipo."' ORDER BY posicion";
				return $bd->select($consulta,ajena);	
			}
			
			/*funcion para insertar clubes a la bd del servicio web*/
			public function inserta_club($club){
				global $bd;
				$consulta ="INSERT INTO clubes (nombre,escudo,direccion_bd,nombre_bd,contrasenya,usuario) 
							VALUES ('".$club->nombre."',
									'".$club->escudo."',
									'".$club->direccion_bd."',
									'".$club->nombre_bd."',
									'".$club->contrasenya."',
									'".$club->usuario."')";
				return $bd->insert($consulta);
				
			}
			/*funcion para modificar clubes en la bd del servicio web*/
			public function modifica_club($club){
				global $bd;
				$consulta ="UPDATE clubes 
							SET escudo='".$club->escudo."',
								direccion_bd='".$club->direccion_bd."',
								nombre_bd='".$club->nombre_bd."',
								contrasenya='".$club->contrasenya."',
								usuario='".$club->usuario."'
							WHERE nombre='".$club->nombre."'";			
				return $bd->insert($consulta);			
			}
			/*funcion para consultar si un club ha sido inscrito con anterioridad en el cms*/
			public function club_nombre($club){
				global $bd;
				$consulta ="SELECT * FROM clubes WHERE nombre = '".$club->nombre."'";
				return $bd->select($consulta,propia);			
			}
			
			/*funcion para consultar los datos de conexion de un club especifico mediante su id en la bd*/
			public function conexion_club($id){
				global $bd;
				$consulta = "SELECT * from clubes WHERE id =".$id;
				return $bd->select($consulta,propia);	
			}
			
			/*funcion para consultar los clubes inscritos en el servicio web*/
			public function clubes_inscritos(){
				global $bd;
				$consulta ="SELECT * FROM clubes";
				return $bd->select($consulta,propia);
			}
			
		}
	
	}
	$query = new clase_consulta();

?>

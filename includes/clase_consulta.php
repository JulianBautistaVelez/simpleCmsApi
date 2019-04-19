<?php

	require_once('clase_bd.php');
	
	if(!class_exists("clase_consulta")){
		class clase_consulta{
			public function posts(){
			global $bd;
			$consulta="SELECT * FROM post ORDER BY fecha DESC";
			return $bd->select($consulta);
			}
			public function post_id($id){
			global $bd;	
			$consulta="SELECT * FROM post WHERE ID = '".$id."'";
			return $bd->select($consulta);
			}
			public function post_cat($cat){
			global $bd;	
			$consulta="SELECT * FROM post WHERE categoria = '".$cat."'";
			return $bd->select($consulta);
			}
			public function config_blog(){
			global $bd;	
			$consulta="SELECT * FROM blog ORDER BY fecha DESC LIMIT 1";
			return $bd->select($consulta);
			}
			public function elimina_post($id){
			global $bd;
			$consulta="DELETE FROM post WHERE id ='".$id."'";
			return $bd->delete($consulta);
			}
			public function busqueda($termino){
			global $bd;
			$consulta ="SELECT * FROM post WHERE titulo LIKE '%".$termino."%' UNION SELECT * FROM post WHERE etiquetas LIKE '%".$termino."%' UNION SELECT * FROM post WHERE texto LIKE '%".$termino."%'";
			return $bd->select($consulta);	
			}
			public function busqueda_equipo($termino){
			global $bd;
			$consulta ="SELECT * FROM post WHERE nombre LIKE '%".$termino."%' UNION SELECT * FROM post WHERE descripcion LIKE '%".$termino."%' UNION SELECT * FROM post WHERE deporte LIKE '%".$termino."%'";
			return $bd->select($consulta);	
			}
			public function busqueda_personal($termino){
			global $bd;
			$consulta ="SELECT * FROM persona WHERE nombre LIKE '%".$termino."%' UNION SELECT * FROM persona WHERE etiquetas LIKE '%".$termino."%' UNION SELECT * FROM persona WHERE descripcion LIKE '%".$termino."%' UNION SELECT * FROM persona WHERE equipo LIKE '%".$termino."%'";
			return $bd->select($consulta);	
			}
			public function id_equipo($id){
			global $bd;
			$consulta ="SELECT * FROM equipo WHERE id ='".$id."'";
			return $bd->select($consulta);	
			}
			public function id_persona($id){
			global $bd;
			$consulta ="SELECT * FROM persona WHERE id ='".$id."'";
			return $bd->select($consulta);	
			}
			public function equipos(){
			global $bd;
			$consulta ="SELECT nombre, deporte FROM equipo";
			return $bd->select($consulta);	
			}
			public function equipos_completo(){
			global $bd;
			$consulta ="SELECT * FROM equipo ORDER BY id DESC";
			return $bd->select($consulta);	
			}
			public function personal_completo(){
			global $bd;
			$consulta ="SELECT * FROM persona";
			return $bd->select($consulta);	
			}
			public function personal_equipo($equipo){
			global $bd;
			$consulta ="SELECT * FROM persona WHERE equipo ='".$equipo."'";
			return $bd->select($consulta);	
			}
			
		}
	
	}
	$query = new clase_consulta();

?>

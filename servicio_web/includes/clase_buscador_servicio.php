
<?php
	require_once('clase_consulta_servicio.php');

	if(!class_exists('clase_buscador_servicio')){
		class clase_buscador_servicio{
			public function busca($post,$tabla){
				global $query;
				if(strcmp($tabla,"post")==0)$post_array = $query->busqueda($post['busqueda']);
				else if (strcmp($tabla,"persona")==0)$post_array = $query->busqueda_personal($post['busqueda']);
				else if (strcmp($tabla,"equipo")==0)$post_array = $query->busqueda_equipo($post['busqueda']);
				return $post_array;
				
			}		
		}
	}
	//INSTANCIA UN OBJETO DE LA CLASE AL EJECUTARSE; AHORA NO NECESITA CREAR UN OBJETO EN CADA SCRIPT QUE LO LLAME
	//SOLO SE DEBE HACER REFERENCIA A LA VARIABLE GLOBAL $insert DE LA FORMA  global $buscador	
	$buscador = new clase_buscador_servicio();

?>

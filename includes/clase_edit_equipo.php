<?php
	require_once('clase_bd.php');
	if(!class_exists('clase_edit_equipo')){
		class clase_edit_equipo{
			public function edit_equipo($entrada, $id_entrada){
				global $bd;
				
				$directorio_ima = "./imagenes/";
				$link_ima = $directorio_ima.basename($_FILES["imagen"]["name"]);
				$upload = 1;
				
				$comprobar = getimagesize($_FILES["imagen"]["tmp_name"]);
				if($comprobar){
					echo "el archivo es una imagen -".$comprobar["mime"].".";
					$upload =1;
				}
				else { echo "el archivo no es una imagen";
					$upload =0;
				}
				
				if ($_FILES["imagen"]["size"] > 20000000) {
					echo "El archivo es muy grande.";
					$upload = 0;
				}
				
				if (file_exists($link_ima)) {
					echo "El archivo ya esta subido, o el nombre ya esta tomado";
					$upload = 0;
				}
				
				if($upload){
					if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $link_ima)){
						echo "el archivo ha sido subido";
					} else {echo "el archivo no ha podido ser subido";
						$upload = 0;
					}
					
					
				}
				if($id_entrada != 0){
					if($upload){
						//printf("usando entrada para modificar post con imagen");
						$consulta = " UPDATE equipo SET nombre = '".$entrada[nombre]."',
														 deporte = '".$entrada[deporte]."',
														 descripcion = '".$entrada[descripcion]."',
														 escudo = '$link_ima',
														 color_1 = '".$entrada[color_1]."',
														 color_2 = '".$entrada[color_2]."'								 
									  WHERE id = '".$id_entrada."'";
								  
						
					} else {
						//printf("usando entrada para modificar post sin imagen");
						$consulta = " UPDATE equipo SET nombre = '".$entrada[nombre]."',
														 deporte = '".$entrada[deporte]."',
														 descripcion = '".$entrada[descripcion]."',
														 color_1 = '".$entrada[color_1]."',
														 color_2 = '".$entrada[color_2]."'								 
									  WHERE id = '".$id_entrada."'";
						
					}	
				}
				else {
					if($upload){
						//printf("usando entrada para insertar post con imagen");
						$consulta = " INSERT INTO equipo (nombre,deporte,descripcion,escudo,color_1,color_2)
									  VALUES ('".$entrada[nombre]."',
											  '".$entrada[deporte]."',
											  '".$entrada[descripcion]."',
											  '$link_ima',
											  '".$entrada[color_1]."',
											  '".$entrada[color_2]."')";
								  
						
					} else {
						//printf("usando entrada para modificar post sin imagen");
						$consulta = " INSERT INTO equipo (nombre,deporte,descripcion,color_1,color_2)
									  VALUES ('".$entrada[nombre]."',
											  '".$entrada[deporte]."',
											  '".$entrada[descripcion]."',
											  '".$entrada[color_1]."',
											  '".$entrada[color_2]."')";
						
					}
				}
				$resultado = $bd->insert($consulta);
				
				
				//header('Location: index.php');
				return $resultado;
				
				
			}		
		}
	}
	//INSTANCIA UN OBJETO DE LA CLASE AL EJECUTARSE; AHORA NO NECESITA CREAR UN OBJETO EN CADA SCRIPT QUE LO LLAME
	//SOLO SE DEBE HACER REFERENCIA A LA VARIABLE GLOBAL $insert DE LA FORMA  global $insert	
	$insert_equipo = new clase_edit_equipo();

?>

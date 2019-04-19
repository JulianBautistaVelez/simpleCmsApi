<?php
	require_once('clase_bd.php');
	if(!class_exists('clase_configura')){
		Class clase_configura{
			public function configura($datos,$id_conf){
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
				
				/*esta sentencia sql creara una entrada nueva en la tabla blog, donde se guarda la configuracion, solo sera usada una primera vez*/
				if($upload && !$id_conf && strlen($datos[contrasenya])>5){
					$consulta = " INSERT INTO blog (nombre,
													contrasenya,
													descripcion,
													logo,
													fuente,
													color_fondo,
													color_nombre_blog,
													color_titulos,
													color_texto,
													color_inicio_degradado,
													color_final_degradado)
								  VALUES ('".$datos[usuario]."',
										  '".$datos[contrasenya]."',
										  '".$datos[descripcion]."',
										  '$link_ima',
										  '".$datos[fuente]."',
										  '".$datos[color_fondo]."',
										  '".$datos[color_nombre_blog]."',
										  '".$datos[color_titulos]."',
										  '".$datos[color_textos]."',
										  '".$datos[color_inicio_degradado]."',
										  '".$datos[color_final_degradado]."')";

					
				} 
				
				else echo "la contraseña debe contener al menos 6 caracteres";
				/*if($upload && !$id_conf && strlen($datos[contrasenya])<=5){
					$consulta = " INSERT INTO blog (nombre,
													descripcion,
													logo,
													fuente,
													color_fondo,
													color_nombre_blog,
													color_titulos,
													color_texto,
													color_inicio_degradado,
													color_final_degradado)
								  VALUES ('".$datos[usuario]."',
										  '".$datos[descripcion]."',
										  '$link_ima',
										  '".$datos[fuente]."',
										  '".$datos[color_fondo]."',
										  '".$datos[color_nombre_blog]."',
										  '".$datos[color_titulos]."',
										  '".$datos[color_textos]."',
										  '".$datos[color_inicio_degradado]."',
										  '".$datos[color_final_degradado]."')";

					
				} */
				
				/*esta sentencia sql actualiza la entrada de la configuracion del blog cuando la nueva contraseña introducida tiene mas de 5 caracteres y algun logo nuevo*/
				if($id_conf!=0 && $upload && strlen($datos[contrasenya])>5){
					$consulta = " UPDATE blog SET nombre ='".$datos[usuario]."',
												  contrasenya ='".$datos[contrasenya]."',
												  descripcion ='".$datos[descripcion]."',
												  logo ='$link_ima',
												  fuente = '".$datos[fuente]."',
												  color_fondo ='".$datos[color_fondo]."',
												  color_nombre_blog ='".$datos[color_nombre_blog]."',
												  color_titulos ='".$datos[color_titulos]."',
												  color_texto ='".$datos[color_textos]."',
												  color_inicio_degradado ='".$datos[color_inicio_degradado]."',
												  color_final_degradado ='".$datos[color_final_degradado]."'
									WHERE id = '".$id_conf."'";
					
				} 
				
				/*esta sentencia sql actualiza la entrada de la configuracion del blog cuando la nueva contraseña introducida tiene mas de 5 caracteres y ningun logo nuevo*/
				if($id_conf!=0 && !$upload && strlen($datos[contrasenya])>5){
					$consulta = " UPDATE blog SET nombre ='".$datos[usuario]."',
												  contrasenya ='".$datos[contrasenya]."',
												  descripcion ='".$datos[descripcion]."',
												  fuente = '".$datos[fuente]."',
												  color_fondo ='".$datos[color_fondo]."',
												  color_nombre_blog ='".$datos[color_nombre_blog]."',
												  color_titulos ='".$datos[color_titulos]."',
												  color_texto ='".$datos[color_textos]."',
												  color_inicio_degradado ='".$datos[color_inicio_degradado]."',
												  color_final_degradado ='".$datos[color_final_degradado]."'
									WHERE id = '".$id_conf."'";
					
				} 
				
				/*esta sentencia sql actualiza la entrada de la configuracion del blog cuando la nueva contraseña introducida tiene menos de 5 caracteres y algun logo nuevo*/
				if($id_conf!=0 && $upload && strlen($datos[contrasenya])<=5){
					$consulta = " UPDATE blog SET nombre ='".$datos[usuario]."',
												  descripcion ='".$datos[descripcion]."',
												  logo ='$link_ima',
												  fuente = '".$datos[fuente]."',
												  color_fondo ='".$datos[color_fondo]."',
												  color_nombre_blog ='".$datos[color_nombre_blog]."',
												  color_titulos ='".$datos[color_titulos]."',
												  color_texto ='".$datos[color_textos]."',
												  color_inicio_degradado ='".$datos[color_inicio_degradado]."',
												  color_final_degradado ='".$datos[color_final_degradado]."'
									WHERE id = '".$id_conf."'";
					
				} 
				
				/*esta sentencia sql actualiza la entrada de la configuracion del blog cuando la nueva contraseña introducida tiene menos de 5 caracteres y ningun logo nuevo*/
				if($id_conf!=0 && !$upload && strlen($datos[contrasenya])<=5){
					$consulta = " UPDATE blog SET nombre ='".$datos[usuario]."',
												  descripcion ='".$datos[descripcion]."',
												  fuente = '".$datos[fuente]."',
												  color_fondo ='".$datos[color_fondo]."',
												  color_nombre_blog ='".$datos[color_nombre_blog]."',
												  color_titulos ='".$datos[color_titulos]."',
												  color_texto ='".$datos[color_textos]."',
												  color_inicio_degradado ='".$datos[color_inicio_degradado]."',
												  color_final_degradado ='".$datos[color_final_degradado]."'
									WHERE id = '".$id_conf."'";
					
				} 

				$resultado = $bd->insert($consulta);
				
				
				
				return $resultado;
			}
		
		}
	}
	$config = new clase_configura();
?>

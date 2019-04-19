<?php
	require_once('clase_bd.php');
	if(!class_exists('clase_insert')){
		class clase_insert{
			public function post($entrada, $id_entrada){
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
				
				if ($_FILES["imagen"]["size"] > 5000000) {
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
						$consulta = " UPDATE post SET titulo = '".$entrada[post_tit]."',
													  texto = '".$entrada[post_cont]."',
													  categoria = '".$entrada[post_cat]."',
													  etiquetas = '".$entrada[post_etiq]."',
													  imagen = '$link_ima'
									  WHERE id = '".$id_entrada."'";
								  
						
					} else {
						$consulta = " UPDATE post SET titulo = '".$entrada[post_tit]."',
													  texto = '".$entrada[post_cont]."',
													  categoria = '".$entrada[post_cat]."',
													  etiquetas = '".$entrada[post_etiq]."'	  
									  WHERE id = '".$id_entrada."'";
						
					}	
				}
				
				else {
					if($upload){
						$consulta = " INSERT INTO post (titulo,texto,equipo,etiquetas,imagen)
									  VALUES ('".$entrada[post_tit]."',
											  '".$entrada[post_cont]."',
											  '".$entrada[post_equipo]."',
											  '".$entrada[post_etiq]."',
											  '$link_ima')";
					printf($consulta);			  
						
					} else {
						$consulta = " INSERT INTO post (titulo,texto,equipo,etiquetas)
									  VALUES ('".$entrada[post_tit]."',
											  '".$entrada[post_cont]."',
											  '".$entrada[post_equipo]."',
											  '".$entrada[post_etiq]."')";
						
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
	$insert = new clase_insert();

?>

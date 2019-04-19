<?php
	require_once('clase_bd.php');
	if(!class_exists('clase_insert')){
		class clase_insert{
			public function post($post, $id_post){
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
				if($id_post != 0){
					echo "HOLA MADAFAKAS";
					if($upload){
						$consulta = " UPDATE post SET titulo = '".$post[post_tit]."',
													  texto = '".$post[post_cont]."',
													  categoria = '".$post[post_cat]."',
													  etiquetas = '".$post[post_etiq]."',
													  imagen = '$link_ima'
									  WHERE id = '".$id_post."'";
								  
						
					} else {
						$consulta = " UPDATE post SET titulo = '".$post[post_tit]."',
													  texto = '".$post[post_cont]."',
													  categoria = '".$post[post_cat]."',
													  etiquetas = '".$post[post_etiq]."'	  
									  WHERE id = '".$id_post."'";
						
					}	
				}
				else {
					if($upload){
						$consulta = " INSERT INTO post (titulo,texto,categoria,etiquetas,imagen)
									  VALUES ('".$post[post_tit]."',
											  '".$post[post_cont]."',
											  '".$post[post_cat]."',
											  '".$post[post_etiq]."',
											  '$link_ima')";
								  
						
					} else {
						$consulta = " INSERT INTO post (titulo,texto,categoria,etiquetas)
									  VALUES ('".$post[post_tit]."',
											  '".$post[post_cont]."',
											  '".$post[post_cat]."',
											  '".$post[post_etiq]."')";
						
					}
				}
				$resultado = $bd->insert($consulta);
				
				
				header('Location: index.php');
				//return $resultado;
				
				
			}		
		}
	}
	//INSTANCIA UN OBJETO DE LA CLASE AL EJECUTARSE; AHORA NO NECESITA CREAR UN OBJETO EN CADA SCRIPT QUE LO LLAME
	//SOLO SE DEBE HACER REFERENCIA A LA VARIABLE GLOBAL $insert DE LA FORMA  global $insert	
	$insert = new clase_insert();

?>

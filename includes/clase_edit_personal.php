<?php
	require_once('clase_bd.php');
	if(!class_exists('clase_edit_personal')){
		class clase_edit_personal{
			public function edit_personal($entrada, $id_entrada){
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
				
				$equ_dep = explode('|',$entrada[equipo_deporte]);
				
				
				if($id_entrada != 0){
					if($upload){
						$consulta = " UPDATE persona SET nombre = '".$entrada[nombre]."',
														 apodo = '".$entrada[apodo]."',
														 posicion = '".$entrada[posicion]."',
														 camiseta = '".$entrada[camiseta]."',
														 altura = '".$entrada[altura]."',
														 peso = '".$entrada[peso]."',
													     descripcion = '".$entrada[descripcion]."',
													     foto = '$link_ima',
														 deporte = '".$equ_dep[1]."',
														 etiquetas = '".$entrada[etiquetas]."',
														 equipo = '".$equ_dep[0]."'								 
									  WHERE id = '".$id_entrada."'";
								  
						
					} else {
						$consulta = " UPDATE persona SET nombre = '".$entrada[nombre]."',
														 apodo = '".$entrada[apodo]."',
														 posicion = '".$entrada[posicion]."',
														 camiseta = '".$entrada[camiseta]."',
														 altura = '".$entrada[altura]."',
														 peso = '".$entrada[peso]."',
													     descripcion = '".$entrada[descripcion]."',
														 deporte = '".$equ_dep[1]."',
														 etiquetas = '".$entrada[etiquetas]."',
														 equipo = '".$equ_dep[0]."'								 
									  WHERE id = '".$id_entrada."'";
						
					}	
				}
				else {
					if($upload){
						$consulta = " INSERT INTO persona (nombre,apodo,posicion,camiseta,altura,peso,descripcion,foto,etiquetas,equipo,deporte)
									  VALUES ('".$entrada[nombre]."',
											  '".$entrada[apodo]."',
											  '".$entrada[posicion]."',
											  '".$entrada[camiseta]."',
											  '".$entrada[altura]."',
											  '".$entrada[peso]."',
											  '".$entrada[descripcion]."',
											  '$link_ima',
											  '".$entrada[etiquetas]."',
											  '".$equ_dep[0]."',
											  '".$equ_dep[1]."')";
								  
						
					} else {
						$consulta = " INSERT INTO persona (nombre,apodo,posicion,camiseta,altura,peso,descripcion,etiquetas,equipo,deporte)
									  VALUES ('".$entrada[nombre]."',
											  '".$entrada[apodo]."',
											  '".$entrada[posicion]."',
											  '".$entrada[camiseta]."',
											  '".$entrada[altura]."',
											  '".$entrada[peso]."',
											  '".$entrada[descripcion]."',
											  '".$entrada[etiquetas]."',
											  '".$equ_dep[0]."',
											  '".$equ_dep[1]."')";
						
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
	$insert_personal = new clase_edit_personal();

?>

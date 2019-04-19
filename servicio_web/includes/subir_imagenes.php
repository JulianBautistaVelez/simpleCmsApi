<?php
public function subir($escudo){
		
	$directorio_ima = "./imagenes/";
	$link_ima = $directorio_ima.basename($_FILES["escudo"]["name"]);
	$upload = 1;
				
	$comprobar = getimagesize($_FILES["escudo"]["tmp_name"]);
	if($comprobar){
		echo "el archivo es una imagen -".$comprobar["mime"].".";
		$upload =1;
		} else { echo "el archivo no es una imagen";
				  $upload =0;
			}
				
	if ($_FILES["escudo"]["size"] > 5000000) {
		echo "El archivo es muy grande.";
					$upload = 0;
	}
				
	if (file_exists($link_ima)) {
		echo "El archivo ya esta subido, o el nombre ya esta tomado";
		$upload = 0;
	}
				
	if($upload){
		if(move_uploaded_file($_FILES["escudo"]["tmp_name"], $link_ima)){
			echo "el archivo ha sido subido";
		} else {echo "el archivo no ha podido ser subido";
			$upload = 0;
			}
		}
		if($upload) return $link_ima;	
		else return false;
							
}		
?>

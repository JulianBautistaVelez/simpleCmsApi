
<?php
	require_once('clase_consulta.php');

	if(!class_exists('clase_login')){
		class clase_login{
			public function log_in($post){
				global $query;
				$contr_blog = $query->config_blog();
				$contr_blog = $contr_blog[0];
				$autentificado = strcmp($contr_blog->contrasenya,$post['contrasenya']);
				if($autentificado==0) $autentificacion = true;
				if($autentificado!=0) {echo "error en la contraseña"; $autentificacion = false;}
				$_SESSION["autentificado"] = $autentificacion;
				header('Location: index.php');
				
			}	
			
			public function log_out($post){
				printf("loco locote");
				$_SESSION["autentificado"] = false;
				//unset($_SESSION["autentificado"]);
				header('Location: index.php');	
			}		
		}
	}
	//INSTANCIA UN OBJETO DE LA CLASE AL EJECUTARSE; AHORA NO NECESITA CREAR UN OBJETO EN CADA SCRIPT QUE LO LLAME
	//SOLO SE DEBE HACER REFERENCIA A LA VARIABLE GLOBAL $insert DE LA FORMA  global $insert	
	$login = new clase_login();

?>

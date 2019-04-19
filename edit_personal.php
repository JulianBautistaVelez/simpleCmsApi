<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors',1);
	session_start();
	
	
	include("cabecera.php");
	require_once('./includes/clase_css_dinamico.php');
	require_once('./includes/clase_consulta.php');
	global $query;
	$configuracion = $query->config_blog();
	$configuracion = $configuracion[0];
	$lista_equipos = $query->equipos();
	
	
	/*Esta parte reconocera si se ha enviado un post a editar y preparará la clase que tratara el formulário*/
	if(!empty($_GET)){
		if(isset($_GET['p'])){
			$id_persona = $_GET['p'];	
			$entrada = $query->id_persona($id_persona);
			$entrada = $entrada[0];
		} 
	}
	/*esta parte enviara a tratar el formulário*/
	if(!empty($_POST)){
		if(isset($entrada)){
			require_once('./includes/clase_edit_personal.php');
			global $insert_personal;
			$insert_personal->edit_personal($_POST,$id_persona);
			//header('Location: index.php');
		}
		else {
			require_once('./includes/clase_edit_personal.php');
			global $insert_personal;
			$insert_personal->edit_personal($_POST,0);
			//header('Location: index.php');
		}

	}
	//if(!$_SESSION["autentificado"]) {header('Location: login.php');}
?>
<!DOCTYPE html lang="es">
	<head>
	<meta charset="utf-8"/>
	<title>Insertar post</title>
	<!--<link rel="stylesheet" type="text/css" href="./includes/standard.css">-->
	<?php global $css; $css->dame_css(); ?>
	</head>
	<body>
	<?php cabecera();?>

	 <div class="margin">
		 <div class="centered">
			<form method="post" enctype="multipart/form-data">
			<!---->
			<h2>
			<p>Nombre: <input type="text" name="nombre" <?php if(isset($entrada->nombre)) echo "value ='".$entrada->nombre."'"; ?> /></p>
			<p>Apodo: <input type="text" name="apodo" <?php if(isset($entrada->apodo)) echo "value ='".$entrada->apodo."'"; ?> /></p>
			<p>Equipo: <select name="equipo_deporte">
				<?php foreach($lista_equipos as $equipo):?>
				<option value="<?php echo $equipo->nombre."|".$equipo->deporte ?>" <?php if(isset($entrada) && strcmp($entrada->nombre,$equipo->nombre)==0 ) echo "selected"; ?>><?php echo $equipo->nombre.", deporte: ".$equipo->deporte;?> </option>
				<?php endforeach ?>
				</select>
				</p>
			<!--FALTA RESOLVER COMO ENVIAR EL DEPORTE DE LA PERSONA-->
			<p>Posición: <input type="text" name="posicion" <?php if(isset($entrada->posicion)) echo "value ='".$entrada->posicion."'"; ?> /></p>
			<p>Número de camiseta: <input type="camiseta" size="3" maxlength="3" name="camiseta" <?php if(isset($entrada->camiseta)) echo "value ='".$entrada->camiseta."'"; ?> /></p>
			<p>Altura: <input type="text" name="altura" size="4" maxlength="4" <?php if(isset($entrada->altura)) echo "value ='".$entrada->altura."'"; ?> /> Cms</p>
			<p>Peso: <input type="text" name="peso" size="3" maxlength="3" <?php if(isset($entrada->peso)) echo "value ='".$entrada->peso."'"; ?> /> Kg</p>
			<p>Descripción: <textarea name="descripcion" style="width: 830px; height: 610px;" maxlength="1000"><?php if(isset($entrada->descripcion)) echo $entrada->descripcion; ?> </textarea></p>		
			
			<p>Sube una foto del miembro del equipo<?php if(isset($entrada->imagen) ) echo ": el jugador actual ya tiene una imagen almacenada, puedes cambiarla subiendo una nueva "; ?></p>
			<input type="file" name="imagen" id="imagen">
			
			
			
			
			
			<p>Etiquetas: <input type="text" name="etiquetas" <?php if(isset($entrada->etiquetas)) echo "value ='".$entrada->etiquetas."'"; ?>/></p>
			<p><input type="submit" value="enviar"/></p>
			</h2>
			</form>
		</div>
	</div>
	</body>
</html>


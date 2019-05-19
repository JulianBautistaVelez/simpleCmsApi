<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors',1);
	session_start();
	
	include("cabecera.php");
	include("footer.php");
	require_once('./includes/clase_css_dinamico.php');
	require_once('./includes/clase_consulta.php');
	global $query;
	$configuracion = $query->config_blog();
	$configuracion = $configuracion[0];
	
	
	/*Esta parte reconocera si se ha enviado un entrada a editar y preparará la clase que tratara el formulário*/
	if(!empty($_GET)){
		if(isset($_GET['id_eq'])){
			$id_equipo = $_GET['id_eq'];	
			$entrada = $query->id_equipo($id_equipo);
			$entrada = $entrada[0];
		} 
	}
	/*esta parte enviara a tratar el formulário*/
	if(!empty($_POST)){
		if(isset($entrada)){
			require_once('./includes/clase_edit_equipo.php');
			global $insert_equipo;
			$insert_equipo->edit_equipo($_POST,$id_equipo);
			header('Location: index.php');
		}
		else {
			require_once('./includes/clase_edit_equipo.php');
			global $insert_equipo;
			$insert_equipo->edit_equipo($_POST,0);
			header('Location: index.php');
		}

	}
	//print_r($_SESSION);
	if(!$_SESSION["autentificado"]) {header('Location: login.php');}
?>
<!DOCTYPE html lang="es">
	<head>
	<meta charset="utf-8"/>
	<title>Insertar entrada</title>
	<!--<link rel="stylesheet" type="text/css" href="./includes/standard.css">-->
	<?php global $css; $css->dame_css(); ?>
	</head>
	<body>
	<?php cabecera_bootstrap();?>

	 <div class="container">
		 <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">
			<form method="post" enctype="multipart/form-data">
			<!---->
			<h2>
			<p>Nombre: <input type="text" name="nombre" <?php if(isset($entrada->nombre)) echo "value ='".$entrada->nombre."'"; ?> /></p>
			
			<p>Deporte: <select name="deporte">
			   <option value="Fútbol" <?php if(isset($entrada) && strcmp($entrada->deporte,"Fútbol")==0 ) echo "selected"; ?>> Fútbol </option>
			   <option value="Baloncesto" <?php if(isset($entrada) && strcmp($entrada->deporte,"Baloncesto")==0 ) echo "selected"; ?>> Baloncesto </option>
			   <option value="Balonmano" <?php if(isset($entrada) && strcmp($entrada->deporte,"balonmano")==0 ) echo "selected"; ?>> Balonmano </option>
			   <option value="Fútbol sala" <?php if(isset($entrada) && strcmp($entrada->deporte,"Fútbol sala")==0 ) echo "selected"; ?>> Fútbol sala </option>
			</select></p>
			
			<p>Descripción: <textarea name="descripcion"   maxlength="1000"><?php if(isset($entrada->descripcion)) echo $entrada->descripcion; ?> </textarea></p>
			
			<p>Sube el escudo del equipo<?php if(isset($entrada->imagen) ) echo ": el equipo ya tiene un escudo subido, puedes cambiarlo subiendo uno nuevo "; ?></p>
			<input type="file" name="imagen" id="imagen">

			<p>Elige los colores del equipo: <input type="color" name="color_1" <?php if(isset($entrada->color_fondo)) echo "value ='".$entrada->color_fondo."'"; else echo "value='#ff0000'";?> > <input type="color" name="color_2" <?php if(isset($configuracion->color_fondo)) echo "value ='".$configuracion->color_fondo."'"; else echo "value='#0000ff'";?> > </p>

			<p><input type="submit" value="enviar"/></p>
			</h2>
			</form>
		</div>
	</div>
	<?php
	footer();
	?>
	</body>
</html>


<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors',1);
	session_start();
	include("cabecera.php");
	include("footer.php");
	require_once('./includes/clase_consulta.php');
	require_once('./includes/clase_css_dinamico.php');
	global $css;
	global $query;
	$configuracion = $query->config_blog();
	$configuracion = $configuracion[0];
	if(!empty($_POST)){
		require_once('./includes/clase_configura.php');
		global $config;
		if(isset($configuracion)) $config->configura($_POST,$configuracion->id);
		else $config->configura($_POST,0);
		//print_r($_POST);
		header('Location: index.php');
	}
	
	if(!$_SESSION["autentificado"] && $_SESSION["primer_ingreso"]) {header('Location: login.php');}
	//print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="es">
 <head>
  <title>Prueba de CMS JULIÁN BAUTISTA</title>
  <?php global $css; $css->dame_css(); ?>
  <meta charset="utf-8"/>
 </head>
 <body>
	 <?php cabecera_bootstrap();?>
	  

			<div class="container">
				<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">
					<form method="post" enctype="multipart/form-data">
					<!---->
					<h2>
					<p>Nombre del blog: <input type="text" name="usuario" <?php if(isset($configuracion->nombre)) echo "value ='".$configuracion->nombre."'"; ?>/></p>
					<p>Contraseña: <input type="password" name="contrasenya"/> <?php if(isset($configuracion->contrasenya)) echo "introducir cualquier valor aqui cambiará la contraseña antigua por el valor introducido"; ?></p>
					<p>Descripción del blog: <textarea name="descripcion" style="width: 830px; height: 610px;"><?php if(isset($configuracion->descripcion)) echo $configuracion->descripcion; ?></textarea></p>
					<p>Elige el logo del blog <?php if(isset($configuracion->logo)) echo "subir una imagen cambiará el actual logo del blog por la imagen subida"; ?></p>
					<input type="file" name="imagen" id="imagen">
					<p>Elige la fuente del blog</p>
					<select name="fuente">
						<option class="fuente1" value ="\'Times New Roman\', Times, serif" <?php if(strcmp($configuracion->fuente,"'Times New Roman', Times, serif"))echo "selected"; ?> >Times</option>
						<option class="fuente2" value ="Georgia, serif" <?php if(strcmp($configuracion->fuente,"Georgia, serif")==0)echo "selected"; ?>>Georgia</option>
						<option class="fuente3" value ="\'Palatino Linotype\', \'Book Antiqua\', Palatino, serif" <?php if(strcmp($configuracion->fuente,"'Palatino Linotype', 'Book Antiqua', Palatino, serif")==0)echo "selected"; ?>>Palatino</option>
						<option class="fuente4" value ="Arial, Helvetica, sans-serif" <?php if(strcmp($configuracion->fuente,"Arial, Helvetica, sans-serif")==0)echo "selected"; ?>>Arial</option>
						<option class="fuente5" value ="\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif" <?php if(strcmp($configuracion->fuente,"'Lucida Sans Unicode', 'Lucida Grande', sans-serif")==0)echo "selected"; ?>>Lucida</option>
						<option class="fuente6" value ="\'Trebuchet MS\', Helvetica, sans-serif" <?php if(strcmp($configuracion->fuente,"'Trebuchet MS', Helvetica, sans-serif")==0)echo "selected"; ?>>Trebuchet</option>			
					</select>
					<p>Colores del blog</p>
					<p>Elige el color de fondo: <input type="color" name="color_fondo"  <?php if(isset($configuracion->color_fondo)) echo "value ='".$configuracion->color_fondo."'"; else echo "value='#f5f5f5'";?> ></p>
					<p>Elige el color del nombre del blog: <input type="color" name="color_nombre_blog" <?php if(isset($configuracion->color_fondo)) echo "value ='".$configuracion->color_fondo."'"; else echo "value='#ffffff'";?> ></p>
					<p>Elige el color de los titulos en los post: <input type="color" name="color_titulos" <?php if(isset($configuracion->color_titulos)) echo "value ='".$configuracion->color_titulos."'"; else echo "value='#ffffff'";?>></p>
					<p>Elige el color de los textos: <input type="color" name="color_textos" <?php if(isset($config->color_textos)) echo "value ='".$configuracion->color_textos."'"; else echo "value='#000000'";?>></p>
					<p>Elige el color de la izquierda de la barra del titulo: <input type="color" name="color_inicio_degradado"  <?php if(isset($configuracion->color_inicio_degradado)) echo "value ='".$configuracion->color_inicio_degradado."'"; else echo "value='#412e4c'";?>></p>
					<p>Elige el color de la derecha de la barra del titulo: <input type="color" name="color_final_degradado" <?php if(isset($configuracion->color_final_degradado)) echo "value ='".$configuracion->color_final_degradado."'"; else echo "value='#b39c68'";?>></p>
					<p><input type="submit" value="enviar"/>
					</h2>
					</form>
				</div>
			</div>

	 <?php
		footer();
	 ?>
 </body>
</html>


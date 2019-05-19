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
	$lista_equipos = $query->equipos();
	
	
	/*Esta parte reconocera si se ha enviado un post a editar y preparará la clase que tratara el formulário*/
	if(!empty($_GET)){
		if(isset($_GET['p'])){
			$id_post = $_GET['p'];	
			$post = $query->post_id($id_post);
			$post = $post[0];
		} 
	}
	/*esta parte enviara a tratar el formulário*/
	if(!empty($_POST)){
		if(isset($post)){
			require_once('./includes/clase_insert.php');
			global $insert;
			$insert->post($_POST,$id_post);
			//header('Location: index.php');
		}
		else {
			require_once('./includes/clase_insert.php');
			global $insert;
			$insert->post($_POST,0);
			//header('Location: index.php');
		}

	}
	//print_r($_SESSION);
	if(!$_SESSION["autentificado"]) {header('Location: login.php');}
?>
<!DOCTYPE html lang="es">
	<head>
	<meta charset="utf-8"/>
	<title>Insertar post</title>
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
			<p>Título: <input type="text" name="post_tit" <?php if(isset($post->titulo)) echo "value ='".$post->titulo."'"; ?> /></p>
			<p>Texto del post: <textarea name="post_cont" ><?php if(isset($post->texto)) echo $post->texto; ?></textarea></p>
			<p>Equipo al que se refiere el post: <select name="post_equipo">
				<?php foreach($lista_equipos as $equipo):?>
				<option value="<?php echo $equipo->nombre ?>" <?php if(isset($post) && strcmp($post->equipo,$equipo->nombre)==0 ) echo "selected"; ?>><?php echo $equipo->nombre;?> </option>
				<?php endforeach ?>
				<option value="ninguno"> Ninguno</option>
				</select>
				</p>
			<p>Categoria del post: <select name="post_cat">
				<option value="noticias" <?php if(isset($post) && strcmp($post->categoria,"noticias")==0 ) echo "selected"; ?>> Noticias</option>
				<option value="media" <?php if(isset($post) && strcmp($post->categoria,"media")==0 ) echo "selected"; ?>> Media</option>
				</select></p>
			<p>Elige imagen del post<?php if(isset($post->imagen) ) echo ": el post actual ya tiene una imagen almacenada, puedes cambiarla subiendo una nueva "; ?></p>
			<input type="file" name="imagen" id="imagen">
			<p>Etiquetas: <input type="text" name="post_etiq" <?php if(isset($post->etiquetas)) echo "value ='".$post->etiquetas."'"; ?>/></p>
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


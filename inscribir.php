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
	

	
	//print_r($_SESSION);
	if(!$_SESSION["autentificado"]) {header('Location: login.php');}
?>



<!DOCTYPE html lang="es">
	<head>
	<meta charset="utf-8"/>
	<title>Insertar post</title>
	
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.4.min.js"></script>
	<?php global $css; $css->dame_css(); ?>
	</head>
	<body>
	<?php cabecera_bootstrap();?>
	
	 <div class="container">
		 <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">
			<form id="formulario" enctype="multipart/form-data" method="post">
			<!---->
			<h2>
			<p>Nombre del club: <input type="text" name="nombre" readonly value ="<?php echo $configuracion->nombre;?>"/></p>
			<p>Url de la imagen del escudo<input type="url" name="escudo"></p>
			<p>Dirección de la base de datos del cms: <input type="text" name="direccion_bd" value =""/></p>
			<p>Nombre de la base de datos del cms: <input type="text" name="nombre_bd" value =""/></p>
			<p>Nombre de usuario de la base de datos del cms (solo con permisos de consulta): <input type="text" name="usuario" value =""/></p>
			<p>contraseña de la base de datos del cms (solo con permisos de consulta): <input type="text" name="contrasenya" value =""/></p>
			
			
			<p><input type="submit" id="enviar" value="enviar"/></p>
			</h2>
			</form>
		</div>
	</div>
	<?php
		footer();
	?>
	</body>
</html>


<script>
    $(document).ready(function(){
			$("#formulario").submit(function(){
				var datos_enviar = $('#formulario').serializeArray();
				$.post("./servicio_web/servicio.php",
					   datos_enviar,
					   function(data){window.alert(data);}
					   );
				console.log(datos_enviar);
			});
	});

</script>

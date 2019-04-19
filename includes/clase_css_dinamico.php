<?php   
	require_once ('clase_consulta.php');
	if(!class_exists('clase_css_dinamico')){
		Class clase_css_dinamico{
			public function dame_css(){
			global $query;
			$configuracion = $query->config_blog();
			$configuracion = $configuracion[0];
	
			//$output = "<script>console.log('cadena consulta: ".print_r($configuracion);."');</script>";
			//echo $output;
			echo "<style>";
			
			//if(!isset($configuracion->color_fondo)) echo "body { background: #f5f5f5;}";
			echo "
			body { background: ". $configuracion->color_fondo .";}";
			
			//if(!isset($configuracion->fuente)) echo "body{font-family:'Courier New', Courier, monospace;}";
			echo "
			body{font-family: ".$configuracion->fuente.";}";
			
			echo "
			.masthead {
				background: -webkit-linear-gradient(45deg, ".$configuracion->color_inicio_degradado.", ".$configuracion->color_final_degradado.");
				background:    -moz-linear-gradient(45deg, ".$configuracion->color_inicio_degradado.", ".$configuracion->color_final_degradado.");
				background:      -o-linear-gradient(45deg, ".$configuracion->color_inicio_degradado.", ".$configuracion->color_final_degradado.");
				background:         linear-gradient(45deg, ".$configuracion->color_inicio_degradado.", ".$configuracion->color_final_degradado.");
			}";
			
			echo "
			.page-header h1 {
				color: ".$configuracion->color_nombre_blog.";
				font-size: 40px;
				margin-left: 25%;
				margin-bottom: 0px;
				padding-top:0.4em;

				text-align: left;
			}";
			
			echo"
			p {
				color:".$configuracion->color_texto.";
				position: relative;
				word-wrap: break-word;
				left:0px; 
				top:0px;
			}		
			";
			echo "
			.textpost {
				max-width: 60%;
			}		
			";
			echo"
			.titulopost{
				color: ".$configuracion->color_titulos.";
				font-size: 40px;
				margin-left: 25%;
				margin-top: 25px;
				margin-bottom: 20px;

				text-align: left;
			}";
			
			echo 
			"
			* {
				margin:0px;
				margin-right:0.5em;
				padding:0px;
			}
			
			contenedor_menu {
			  background: rgba(0,0,0,0.9);
			  width: 100%;
			  top:0em;
			  left:0em;
			  position: fixed;
			  z-index: 99;
			}
			
			ul, ol {
				list-style:none;
			}
			
			.nav > li {
				float:left;
			}
			
			.nav li a {
				background-color:#000;
				color:#fff;
				text-decoration:none;
				display:block;
			}
			
			.nav li a:hover {
				background-color:#434343;
			}
			
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
			}
			
			.nav li:hover > ul {
				display:block;
			}
			
			.nav li ul li {
				position:relative;
			}
			
			.nav li ul li ul {
				right:-140px;
				top:0px;
			}
			
			
			
			
			.buscador{
				margin: 0 auto;
				text-align: center
			}
			
			.media {
				position: relative;
				max-width: 100%;
				min-height: 400px;
				margin-left: auto;
			}

			
			a {
				text-decoration: none;
				color: #4169e1;
			}

			a:hover {
				text-decoration: none;
				color: #dc143c;
			}

			.error {
				display: inline-block;
				float: left;
				color: red;
			}

			.success {
				display: inline-block;
				float: left;
				color: #9bba1c;
			}

			.centered{
				margin-left:auto;
				margin-right:auto;
				max-width:40%;
			}

			.margin {
				margin-top: 2em;
				margin-bottom: 2em;
				margin-left: 2em;
				margin-right: 2em;
			}

			.border {
				margin-left: 16%;
				margin-right: 1em;
				border: 3px solid #BCB0A1;
				width: 68%; 
				margin-top: 1em;
				min-height: 350px;
				
			}

			.padding {
				position: relative;
				margin-left: 1em;
				margin-right: 1em;
				margin-top: 1em;
				margin-bottom: 1em;
				
			}
			.content {
				position: relative;
			}


			.imagepost{
				position: relative;
			}

			

			.postimage {
				max-width: 36%;
				max-height: 300px;
				position: absolute;
				left:63%;
				top:0px;
			}

			.logo{
				max-width: 9em;
				max-height: 4.7em;
				padding-bottom:1.5em;
				right:0em;
				top:0em;
				float:right;
				position:fixed;
				z-index: 100;
			}

			h2 {
				text-align:center;

			}

			

			/* Blog */
		
			a.monstra-blog-tag {
				float: left;

				padding: 5px;

				text-decoration: none;
			}

			

			.navbar {
				margin-bottom: 0;

				border: 0;
				border-radius: 0;
				background-color: transparent;
				background-color: #fff;
			}

			.navbar-nav {
				float: right;
			}

			.icon-bar {
				background: #333;
			}

			.navbar-nav a {
				color: #696969;
			}

			.navbar-nav > li > a:hover {
				color: #000;
				background: transparent;
			}

			.navbar-nav a:hover {
				color: #000;
				background: transparent;
			}

			.navbar-nav > li.active > a {
				color: #000;
				background: transparent;
			}

			a.navbar-brand {
				font-size: 36px;

				color: #000;
			}

			.navbar .container {
				margin-top: 20px;
				margin-bottom: 20px;
			}

			.page-header {
				margin-top: 0px;
				margin-right: auto;
				margin-bottom: 0px;:
				padding-top: 5px;
				padding-bottom: 5px;
				position: relative;
				min-height:1.4em;
				border: none;
				border-bottom: none;
			}

			.tags .label {
				font-size: 14px;
			}

			.container-wide {
				padding-top: 20px;
				padding-bottom: 20px;

				background: #fff;
			}

			footer {
				margin-top: 20px;
				margin-bottom: 20px;

				color: #aaa;
			}

			@media (max-width: 600px) {
				.navbar-nav {
					float: left;
				}
			}

			.fuente1{font-family: 'Times New Roman', Times, serif;}
			.fuente2{font-family: Georgia, serif}
			.fuente3{font-family: 'Palatino Linotype', 'Book Antiqua', Palatino, serif}
			.fuente4{font-family: Arial, Helvetica, sans-serif}
			.fuente5{font-family: 'Lucida Sans Unicode', 'Lucida Grande', sans-serif}
			.fuente6{font-family: 'Trebuchet MS', Helvetica, sans-serif}";

			echo "</style>";
			}
		}
	}
	$css = new clase_css_dinamico();
?>

	
	


	



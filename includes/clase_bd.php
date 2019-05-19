<?php
	if(!class_exists("clase_bd")){
		class clase_bd{
		protected $mysqli;
		//protected $xml;
		protected $bd;
		protected $direccionBd= 'YOURDBURL';
		protected $usuarioBd='YOURDBUSER';
		protected $passwordBd='YOURDBPASSWORD';
		protected $nombreBd='YOURDBNAME';
		
			public function __construct(){
				global $mysqli;
				
				session_start();
				$mysqli = new mysqli($this->direccionBd,$this->usuarioBd,$this->passwordBd);
				
				
				if($mysqli->connect_errno){
					printf("problema al conectar con la base de datos: %s\n",$mysqli->connect_errno);
				}
				/*AQUI SE HA DE COMPROBAR SI LA BASE DE DATOS ESTA CREADA Y DE NO
				* SER ASI DEBE CREARSE */
				
				
				$resultado = $mysqli->select_db($this->nombreBd);
				
				if(!$resultado){
					printf("no existia la base de datos %s\n ",$mysqli->errno);
					clase_bd::crea_bd();	
					clase_bd::crea_tabla_blog();	
					clase_bd::crea_tabla_post();
					clase_bd::crea_tabla_equipo();	
					clase_bd::crea_tabla_persona();
					$_SESSION['primer_ingreso']=true;
				}				
				return $mysqli;
			}
			
			function crea_tabla_post(){
				global $mysqli;
				$consulta = "CREATE TABLE post ( 
							 id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
							 titulo VARCHAR(200) NOT NULL, 
							 texto VARCHAR(10000) , 
							 categoria VARCHAR(50) NOT NULL,
							 etiquetas VARCHAR(500), 
							 imagen VARCHAR(500), 
							 equipo VARCHAR(400),
							 fecha TIMESTAMP)";

				$resultado = $mysqli->query($consulta);
				
				if(!$resultado){printf("Error creando la tabla post, error número = %s\n ",$this->conexion->errno);}	
				else {printf("Tabla post creada ");}
				
			}
			
			function crea_tabla_blog(){
				global $mysqli;
				$consulta = "CREATE TABLE blog ( 
							 id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
							 nombre VARCHAR(200) NOT NULL, 
							 contrasenya VARCHAR(100) NOT NULL,
							 descripcion VARCHAR(1000), 
							 logo VARCHAR(900) NOT NULL,
							 fuente VARCHAR(200), 
							 color_fondo VARCHAR(7), 
							 color_nombre_blog VARCHAR(7), 
							 color_titulos VARCHAR(7), 
							 color_texto VARCHAR(7), 
							 color_inicio_degradado VARCHAR(7),
							 color_final_degradado VARCHAR(7), 
							 fecha TIMESTAMP)";

				$resultado = $mysqli->query($consulta);
				
				if(!$resultado){printf("Error creando la tabla blog, error número = %s\n ",$this->conexion->errno);}	
				else {printf("Tabla blog creada");}
				
			}
			
			function crea_tabla_equipo(){
				global $mysqli;
				$consulta = "CREATE TABLE equipo ( 
							 id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
							 nombre VARCHAR(200) NOT NULL,
							 deporte VARCHAR (20) NOT NULL,
							 descripcion VARCHAR(1000), 
							 escudo VARCHAR(900) NOT NULL,
							 color_1 VARCHAR(7), 
							 color_2 VARCHAR(7))";

				$resultado = $mysqli->query($consulta);
				
				if(!$resultado){printf("Error creando la tabla equipo, error número = %s\n ",$this->conexion->errno);}	
				else {printf("Tabla equipo creada ");}
				
			}
			
			function crea_tabla_persona(){
				global $mysqli;
				$consulta = "CREATE TABLE persona ( 
							 id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
							 nombre VARCHAR(200) NOT NULL,
							 apodo VARCHAR (200) ,
							 posicion VARCHAR (200),
							 camiseta VARCHAR (4) ,
							 altura VARCHAR (3) ,
							 peso VARCHAR (3) ,
							 descripcion VARCHAR(1000),
							 foto VARCHAR(900) NOT NULL,
							 deporte VARCHAR (200) ,
							 etiquetas VARCHAR (500),
							 equipo VARCHAR (200))";

				$resultado = $mysqli->query($consulta);
				
				if(!$resultado){printf("Error creando la tabla equipo, error número = %s\n ",$this->conexion->errno);}	
				else {printf("Tabla equipo creada ");}
				
			}
			
			function crea_bd(){
				global $mysqli;
				$consulta = "CREATE DATABASE ". $this->nombre_bd;
				$resultado = $mysqli->query($consulta);
				printf("base de datos creada = %s\n ",$resultado);
				$mysqli->select_db($this->nombre_bd);
					
			}
			
			public function insert($consulta){
				global $mysqli;

				$resultado= $mysqli->query($consulta);
				if(!$resultado){printf("no se ha podido insertar %d ", $mysqli->errno);}
				return $resultado;
				
			}
			
			public function select($consulta){
			global $mysqli;
				$result= $mysqli->query($consulta);
				
				if(!$result){printf("Error consultando, error número = %s\n ",$this->conexion->errno);}
				//guardar el resultado en un array, pasa de ser un objeto mysql a un array de datos 
				while($object = $result->fetch_object()){
				$resultado[] = $object;		
				}
				return $resultado;
			}
			
			public function delete($consulta){
			global $mysqli;

				$resultado= $mysqli->query($consulta);
				if(!$resultado){printf("no se ha podido eliminar %d", $mysqli->errno);}
				return $resultado;
				
			}
			
			
				
		}
	}
	//INSTANCIA UN OBJETO DE LA CLASE AL EJECUTARSE; AHORA NO NECESITA CREAR UN OBJETO EN CADA SCRIPT QUE LO LLAME
	//SOLO SE DEBE HACER REFERENCIA A LA VARIABLE GLOBAL $bd DE LA FORMA  global $bd
	$bd= new clase_bd();
?>

<?php
	if(!class_exists("clase_bd_servicio")){
		class clase_bd_servicio{
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
				$mysqli2;
				
				
				if($mysqli->connect_errno){
					printf("problema al conectar con la base de datos: %s\n",$mysqli->connect_errno);
				}
				/*AQUI SE HA DE COMPROBAR SI LA BASE DE DATOS ESTA CREADA Y DE NO
				* SER ASI DEBE CREARSE */
				
				
				$resultado = $mysqli->select_db($this->nombreBD);
				
				if(!$resultado){
					printf("no existia la base de datos %s\n ",$mysqli->errno);
					clase_bd_servicio::crea_bd();	
					clase_bd_servicio::crea_tabla_clubes();
				}				
				return $mysqli;
			}
			
			function crea_tabla_clubes(){
				global $mysqli;
				$consulta = "CREATE TABLE clubes ( 
							 id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
							 nombre VARCHAR(300) NOT NULL, 
							 escudo VARCHAR(1000) NOT NULL, 
							 direccion_bd VARCHAR(500) NOT NULL,
							 nombre_bd VARCHAR(500) NOT NULL, 
							 contrasenya VARCHAR(200) NOT NULL,
							 usuario VARCHAR(200) NOT NULL)";

				$resultado = $mysqli->query($consulta);
				
				if(!$resultado){printf("Error creando la tabla post, error número = %s\n ",$this->conexion->errno);}	
				else {printf("Tabla post creada ");}
				
			}
			
			
			function crea_bd(){
				global $mysqli;
				$consulta = "CREATE DATABASE ". $this->nombre_bd;
				$resultado = $mysqli->query($consulta);
				printf("base de datos creada = %s\n ",$resultado);
				$mysqli->select_db($this->nombreBd);
					
			}
			
			public function crea_segunda_conexion($enlace){
				global $mysqli2;

				$mysqli2 = new mysqli($enlace->direccion_bd,$enlace->usuario,$enlace->contrasenya, $enlace->nombre_bd);

			}
			
			public function insert($consulta){
				//strcmp regresa 0 si las dos cadenas comparadas son iguales
				global $mysqli;
				$resultado= $mysqli->query($consulta);
				if(!$resultado){printf("no se ha podido insertar %d ", $mysqli->errno);}
				return $resultado;
			}
			
			public function select($consulta, $bd_propiedad){
				if($bd_propiedad){
					//printf("consultando base de datos propia ");
					global $mysqli;
					$result= $mysqli->query($consulta);
					
					if(!$result){printf("Error consultando, error número = %s\n ",$this->conexion->errno);}
					//guardar el resultado en un array, pasa de ser un objeto mysql a un array de datos 
					while($object = $result->fetch_object()){
						$resultado[] = $object;			
					}
					return $resultado;
					}
				else {
					//printf("consultando base de datos ajena ");
					global $mysqli2;
					$result= $mysqli2->query($consulta);
					
					if(!$result){printf("Error consultando, error número = %s\n ",$this->conexion->errno);}
					//guardar el resultado en un array, pasa de ser un objeto mysql a un array de datos 
					while($object = $result->fetch_object()){
						$resultado[] = $object;			
					}
					return $resultado;
				}
			}		
				
		}
	}

	$bd= new clase_bd_servicio();
?>

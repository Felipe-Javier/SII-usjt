<?php 
	
	require_once ('../../Conexión/connection.php');

	class seguridad_usuario extends connection { //  <-- agregar para instanciar una clase dentro de otra clase
		private $connection;
		
		public function __construct() {
			$this->connection = $this;
		}

		public function sanitize_str ($Value) {
			$result = filter_var($Value, FILTER_SANITIZE_STRING);
			return $result;
		}

		public function sanitize_int ($Value) {
			$result = filter_var($Value, FILTER_SANITIZE_NUMBER_INT);
			return $result;
		}

		public function consultar_roles_usuario () {
			try {	
			    $query = "EXEC spTraerRoles";
				$result = $this->connection->connect_db()->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$result->execute();

				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}

		public function buscar_empleado_alumno ($Clave, $TipoPersona) {
			try {	
			    $query = "EXEC spBuscarEmpleadoAlumno ?, ?";
				$result = $this->connection->connect_db()->prepare($query);
				$result->bindValue(1, $Clave, PDO::PARAM_STR);
				$result->bindValue(2, $TipoPersona, PDO::PARAM_STR);
				$result->execute();

				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}

		public function registrar_usuario($NumEmpleado, $IdPersona, $IdAlumno, $IdInstructor, $Nombres, $ApellidoPaterno, $ApellidoMaterno, 
												 $Usuario, $Contrasenia, $ContraseniaTemp, $Activo, $Bloqueado, $IdRolUsuario, $IdUsuarioRegistra) {
			try {	
				$query = "EXEC spRegistrarUsuarios ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
				$result = $this->connection->connect_db()->prepare($query);
				$result->bindValue(1, $NumEmpleado, PDO::PARAM_INT|PDO::PARAM_NULL);
				$result->bindValue(2, $IdPersona, PDO::PARAM_INT);
				$result->bindValue(3, $IdAlumno, PDO::PARAM_INT);
				$result->bindValue(4, $IdInstructor, PDO::PARAM_INT|PDO::PARAM_NULL);
				$result->bindValue(5, $Nombres, PDO::PARAM_STR);
				$result->bindValue(6, $ApellidoPaterno, PDO::PARAM_STR);
				$result->bindValue(7, $ApellidoMaterno, PDO::PARAM_STR);
				$result->bindValue(8, $Usuario, PDO::PARAM_STR);
				$result->bindValue(9, $Contrasenia, PDO::PARAM_STR);
				$result->bindValue(10, $ContraseniaTemp, PDO::PARAM_INT);
				$result->bindValue(11, $Activo, PDO::PARAM_INT);
				$result->bindValue(12, $Bloqueado, PDO::PARAM_INT);
				$result->bindValue(13, $IdRolUsuario, PDO::PARAM_INT);
				$result->bindValue(14, $IdUsuarioRegistra, PDO::PARAM_INT);
				$result->execute();
										
				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}
		
		public function actrec_contraseña_usuario ($Action, $IdUsuario, $Usuario, $Password, $PasswordTemp, $IdRolUsuario,
													   $NumEmpleado, $IdUsuarioActualiza) {
			try {	
			    $query = "EXEC spActualizarRecuperarContraseniaUsuarios ?, ?, ?, ?, ?, ?, ?, ?";
				$result = $this->connection->connect_db()->prepare($query);
				$result->bindValue(1, $Action, PDO::PARAM_STR);
				$result->bindValue(2, $IdUsuario, PDO::PARAM_INT|PDO::PARAM_NULL);
				$result->bindValue(3, $Usuario, PDO::PARAM_STR);
                $result->bindValue(4, $Password, PDO::PARAM_STR);
                $result->bindValue(5, $PasswordTemp, PDO::PARAM_STR|PDO::PARAM_NULL);
                $result->bindValue(6, $IdRolUsuario, PDO::PARAM_INT);
				$result->bindValue(7, $NumEmpleado, PDO::PARAM_INT|PDO::PARAM_NULL);
				$result->bindValue(8, $IdUsuarioActualiza, PDO::PARAM_INT);
				$result->execute();

				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}

        public function encriptar($Password) {
            $PassEncoded = base64_encode(openssl_encrypt('pruebaOficial', 'aes-128-cbc', md5('EncryptDecript20'), false, 'EncryptDecript20'));
            return $PassEncoded;
        }
        
        public function desencriptar($Password) {
            $PassDecoded = rtrim(openssl_decrypt(base64_decode($PassEncoded), 'aes-128-cbc', md5('EncryptDecript20'), false, 'EncryptDecript20'), '\0');
            return $PassDecoded;
        }
    }

?>

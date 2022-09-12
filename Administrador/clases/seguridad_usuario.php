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

		public function actualizar_contraseña_usuario ($IdUsuario, $UserName, $Password, $PasswordTemp, $RolUsuario) {
			try {	
			    $query = "EXEC spActualizarContraseñaUsuarios ?, ?, ?, ?, ?";
				$result = $this->connection->connect_db()->prepare($query);
				$result->bindValue(1, $IdUsuario, PDO::PARAM_STR);
				$result->bindValue(2, $UserName, PDO::PARAM_INT);
                $result->bindValue(3, $Password, PDO::PARAM_STR);
                $result->bindValue(4, $PasswordTemp, PDO::PARAM_STR);
                $result->bindValue(5, $RolUsuario, PDO::PARAM_STR);
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

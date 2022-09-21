<?php 
	
	include_once ('../../Conexión/connection.php');

	
	class seguridad_usuario {
		
		public function __construct() {
			$this->connection = new connection();
		}

		public function sanitize_str ($Value) {
			$result = filter_var($Value, FILTER_SANITIZE_STRING);
			return $result;
		}

		public function sanitize_int ($Value) {
			$result = filter_var($Value, FILTER_SANITIZE_NUMBER_INT);
			return $result;
		}

		public function sing_in ($tipo_identificacion, $usuario, $contraseña) {
			try {
				$query = "EXEC spIniciarSesionSistemaWeb '$tipo_identificacion', '$usuario', '$contraseña'";
				$result = $this->connection->connect_db()->prepare($query);
				/*$result->bindValue(1, $rol_usuario, PDO::PARAM_STR);
				$result->bindValue(2, $usuario, PDO::PARAM_STR);
				$result->bindValue(3, $contraseña, PDO::PARAM_STR);*/
				$result->execute();
					
				return $result;
			} catch (PDOException $exp) {
				return false;
			}
		}

		public function registro_bitacora ($IdUsuario, $TipoMovimiento, $Valor, $TipoSistema) {
			try {
				$query = "EXEC spRegistroBitacora ?, ?, ?, ?";
				$result = $this->connection->connect_db()->prepare($query);
				$result->bindValue(1, $IdUsuario, PDO::PARAM_INT);
				$result->bindValue(2, $TipoMovimiento, PDO::PARAM_STR);
				$result->bindValue(3, $Valor, PDO::PARAM_STR);
				$result->bindValue(4, $TipoSistema, PDO::PARAM_STR);
				$result->execute();

            	return $result;
			} catch (PDOException $exp) {
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
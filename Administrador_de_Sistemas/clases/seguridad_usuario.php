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

		public function registrar_usuario($NumEmpleado, $IdPersona, $IdInstructor, $IdAlumno, $IdAlumnoMatricula, $IdProcesoAspirante,
										  $Nombres, $ApellidoPaterno, $ApellidoMaterno, $Usuario, $Contrasenia, $ContraseniaTemp, $Activo, 
										  $Bloqueado, $IdRolUsuario, $IdUsuarioRegistra) {
			try {	
				//$query = "EXEC spRegistrarUsuarios ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
				$query = "EXEC spRegistrarUsuarios @NumEmpleado='$NumEmpleado', @IdPersona='$IdPersona', @IdAlumno='$IdAlumno', ".
				"@IdProcesoAspirante='$IdProcesoAspirante', @IdAlumnoMatricula='$IdAlumnoMatricula', @IdInstructor='$IdInstructor', ".
				"@Nombres='$Nombres', @ApellidoPaterno='$ApellidoPaterno', @ApellidoMaterno='$ApellidoMaterno', @Usuario='$Usuario', ".
				"@Contrasenia='$Contrasenia', @ContraseniaTemp='$ContraseniaTemp', @Activo='$Activo', @Bloqueado='$Bloqueado', ".
				"@IdRolUsuario='$IdRolUsuario', @IdUsuarioRegistra='$IdUsuarioRegistra'";
				$result = $this->connection->connect_db()->prepare($query);
				/*$result->bindValue(1, $NumEmpleado, PDO::PARAM_INT|PDO::PARAM_NULL);
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
				$result->bindValue(14, $IdUsuarioRegistra, PDO::PARAM_INT);*/
				$result->execute();
										
				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}

		public function actualizar_contraseña_usuario ($IdUsuario, $Usuario, $Password, $PasswordTemp, $IdRolUsuario) {
			try {	
			    $query = "EXEC spActualizarContraseniaUsuarios ?, ?, ?, ?, ?";
				$result = $this->connection->connect_db()->prepare($query);
				$result->bindValue(1, $IdUsuario, PDO::PARAM_INT|PDO::PARAM_NULL);
				$result->bindValue(2, $Usuario, PDO::PARAM_STR);
                $result->bindValue(3, $Password, PDO::PARAM_STR);
                $result->bindValue(4, $PasswordTemp, PDO::PARAM_STR|PDO::PARAM_NULL);
                $result->bindValue(5, $IdRolUsuario, PDO::PARAM_INT);
				$result->execute();

				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}
		
		public function recuperar_contraseña_usuario ($IdUsuarioActualiza, $Usuario, $Password, $PasswordTemp, $IdRolUsuario,
													   $NumEmpleado) {
			try {	
			    $query = "EXEC spRecuperarContraseniaUsuarios ?, ?, ?, ?, ?, ?";
				$result = $this->connection->connect_db()->prepare($query);
				$result->bindValue(1, $IdUsuarioActualiza, PDO::PARAM_INT|PDO::PARAM_NULL);
				$result->bindValue(2, $Usuario, PDO::PARAM_STR);
                $result->bindValue(3, $Password, PDO::PARAM_STR);
                $result->bindValue(4, $PasswordTemp, PDO::PARAM_STR|PDO::PARAM_NULL);
                $result->bindValue(5, $IdRolUsuario, PDO::PARAM_INT);
				$result->bindValue(6, $NumEmpleado, PDO::PARAM_INT|PDO::PARAM_NULL);
				$result->execute();

				return $result;
			} catch(PDOException $exp) {
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

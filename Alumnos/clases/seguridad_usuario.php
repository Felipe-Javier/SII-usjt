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

		public function actualizar_contraseña_usuario ($Action, $IdUsuario, $Usuario, $Password, $PasswordTemp, $IdRolUsuario,
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
    }

?>

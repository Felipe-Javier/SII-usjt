<?php 
	
	require_once ('../../Conexión/connection.php');

	class seguridad_usuario extends connection { //  <-- agregar para instanciar una clase dentro de otra clase
		private $connection;
		
		public function __construct() {
			$this->connection = $this;
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
    }

?>

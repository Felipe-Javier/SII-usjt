<?php 
	
	include_once ('../../Conexión/connection.php');

	
	class iniciar_sesion {
		
		public function __construct() {
			$this->connection = new connection();
		}

	 	public function sing_in ($rol_usuario, $usuario, $contraseña) {
			$query = "EXEC spIniciarSesionSistemaWeb '$rol_usuario', '$usuario', '$contraseña'";
            $result = $this->connection->connect_db()->prepare($query);
			/*$result->bindValue(1, $rol_usuario, PDO::PARAM_STR);
			$result->bindValue(2, $usuario, PDO::PARAM_STR);
			$result->bindValue(3, $contraseña, PDO::PARAM_STR);*/
            $result->execute();

            if (!$result) {
                return false;
            }
				
			return $result;
		}
	}
?>
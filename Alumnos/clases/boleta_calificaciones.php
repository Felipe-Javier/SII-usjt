<?php 
	
	include_once ('../../Conexión/connection.php');
	
	class boleta_calificaciones {
		
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

	 	public function consultar_periodos ($Matricula) {
			$query = "EXEC spTraerCiclosEscolaresPorAlumnoMatricula ?";
            $result = $this->connection->connect_db()->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$result->bindValue(1, $Matricula, PDO::PARAM_STR);
            $result->execute();

            if (!$result) {
                return false;
            }
				
			return $result;
		}

		public function consultar_calificaciones ($Matricula, $IdCiclo) {
			$query = "EXEC spTraerCalificacionesMateriasAlumnoMatricula ?, ?";
            $result = $this->connection->connect_db()->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$result->bindValue(1, $Matricula, PDO::PARAM_STR);
			$result->bindValue(2, $IdCiclo, PDO::PARAM_INT);
            $result->execute();

            if (!$result) {
                return false;
            }
				
			return $result;
		}
	}
?>
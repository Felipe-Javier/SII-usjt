<?php 
	
	include_once ('../../Conexión/connection.php');
	
	class boleta_calificaciones {
		
		public function __construct() {
		    $this->connection = new connection();
		}

	 	public function consultar_periodos ($Matricula) {
			$query = "EXEC spCiclosEscolaresPorMatricula ?";
            $result = $this->connection->connect_db()->prepare($query);
			$result->bindValue(1, $Matricula, PDO::PARAM_STR);
            $result->execute();

            if (!$result) {
                return false;
            }
				
			return $result;
		}

		public function consultar_calificaciones ($Matricula, $IdCiclo) {
			$query = "EXEC spTraerCalificacionesMateriasAlumnoMatricula ?, ?";
            $result = $this->connection->connect_db()->prepare($query);
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
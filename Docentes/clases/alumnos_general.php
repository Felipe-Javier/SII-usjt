<?php 
	
	require_once ('../../Conexión/connection.php');

	class alumnos_general extends connection {
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
        
        public function consultar_alumnos ($IdInstructor, $IdGrupo, $IdPlanMateria) {
			try {
				$query = "EXEC spTraerAlumnosPorGrupoMateriaDocente ?, ?, ?";
				$result = $this->connection->connect_db()->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$result->bindValue(1, $IdInstructor, PDO::PARAM_INT);
				$result->bindValue(2, $IdGrupo, PDO::PARAM_INT);
				$result->bindValue(3, $IdPlanMateria, PDO::PARAM_INT);
				$result->execute();
					
				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}
    }

?>
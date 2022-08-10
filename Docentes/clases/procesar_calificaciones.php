<?php 
	
	require_once ('../../Conexión/connection.php');

	class procesar_calificaciones extends connection { //  <-- agregar para instanciar una clase dentro de otra clase
		private $connection;
		
		public function __construct() {
			$this->connection = $this;
		}

	 	public function consultar_grupos ($IdInstructor, $IdPersona) {
			try {	
			    $query = "EXEC spTraerGruposPorDocente ?, ?";
				$result = $this->connection->connect_db()->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$result->bindValue(1, $IdInstructor, PDO::PARAM_INT);
				$result->bindValue(2, $IdPersona, PDO::PARAM_INT);
				$result->execute();

				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}

		public function consultar_alumnos ($IdGrupo, $IdInstructor) {
			try {
				$query = "EXEC spTraerAlumnosPorGrupoDocente ?, ?";
				$result = $this->connection->connect_db()->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$result->bindValue(1, $IdGrupo, PDO::PARAM_INT);
				$result->bindValue(2, $IdInstructor, PDO::PARAM_INT);
				$result->execute();
					
				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}

		public function consultar_calificaciones ($IdGrupo, $IdInstructor) {
			try {
				$query = "EXEC spTraerAlumnosPorGrupoDocente ?, ?";
				$result = $this->connection->connect_db()->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$result->bindValue(1, $IdGrupo, PDO::PARAM_INT);
				$result->bindValue(2, $IdInstructor, PDO::PARAM_INT);
				$result->execute();
					
				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}
	}

?>
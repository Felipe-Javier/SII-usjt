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

		public function registrar_calificaciones ($Matricula, $IdRelGrupoAlumno, $Calificacion, $IdTipoCorte, $IdTipoCalificacion,
		                                          $IdPlanMateria, $IdUsuario) {
			try {
				$query = "EXEC spGuardarCalificacionesMateriasAlumnoMatricula ?, ?, ?, ?, ?, ?, ?";
				$result = $this->connection->connect_db()->prepare($query);
				$result->bindValue(1, $Matricula, PDO::PARAM_STR);
				$result->bindValue(2, $IdRelGrupoAlumno, PDO::PARAM_INT);
				$result->bindValue(3, $Calificacion, PDO::PARAM_INT);
				$result->bindValue(4, $IdTipoCorte, PDO::PARAM_INT);
				$result->bindValue(5, $IdTipoCalificacion, PDO::PARAM_INT);
				$result->bindValue(6, $IdPlanMateria, PDO::PARAM_INT);
				$result->bindValue(7, $IdUsuario, PDO::PARAM_INT);
				$result->execute();
					
				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}
	}

?>
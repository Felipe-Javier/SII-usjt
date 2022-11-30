<?php 
	
	require_once ('../../Conexión/connection.php');

	class procesar_calificaciones extends connection { //  <-- agregar para instanciar una clase dentro de otra clase
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

		public function sanitize_array ($Value) {
			$result = filter_var_array($Value, FILTER_SANITIZE_STRING);
			return $result;
		}

		public function consultar_grupos_por_docente ($Opcion, $IdInstructor, $IdPersona, $Anio, $IdCiclo, $IdGrupo) {
			try {	
			    $query = "EXEC spTraerGruposPorDocente ?, ?, ?, ?, ?, ?";
				$result = $this->connection->connect_db()->prepare($query);
				$result->bindValue(1, $Opcion, PDO::PARAM_STR);
				$result->bindValue(2, $IdInstructor, PDO::PARAM_INT);
				$result->bindValue(3, $IdPersona, PDO::PARAM_INT);
				$result->bindValue(4, $Anio, PDO::PARAM_STR|PDO::PARAM_NULL);
				$result->bindValue(5, $IdCiclo, PDO::PARAM_INT|PDO::PARAM_NULL);
				$result->bindValue(6, $IdGrupo, PDO::PARAM_INT|PDO::PARAM_NULL);
				$result->execute();

				return $result;
			} catch(PDOException $exp) {
				return $exp;
			}
		}

		public function consultar_calificaciones_alumnos ($IdInstructor, $IdGrupo, $IdPlanMateria) {
			try {
				$query = "EXEC spTraerCalificacionesAlumnosPorGrupoMateriaDocente ?, ?, ?";
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

		public function consultar_CatTipoCorte () {
			try {
				$query = "EXEC spTraerCatTipoCorte";
				$result = $this->connection->connect_db()->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$result->execute();
					
				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}

		public function consultar_CatTipoCalificacion () {
			try {
				$query = "EXEC spTraerCatTipoCalificacion";
				$result = $this->connection->connect_db()->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$result->execute();
					
				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}

		public function registrar_calificaciones ($Matricula, $IdRelGrupoAlumno, $Calificacion, $IdTipoCorte, $IdTipoCalificacion,
		                                          $IdPlanMateria, $IdUsuario) {
			try {
				$query = "EXEC spGuardarModificarCalificacionesAlumnosPorMateriaGrupo ?, ?, ?, ?, ?, ?, ?";
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
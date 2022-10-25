<?php 
	
	require_once ('../../Conexión/connection.php');

	class procesar_asistencias extends connection { //  <-- agregar para instanciar una clase dentro de otra clase
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
				/*$options = array(PDO::SQLSRV_ATTR_ENCODING => PDO::SQLSRV_ENCODING_SYSTEM);*/
				$result = $this->connection->connect_db()->prepare($query, /*$options*/);
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

		public function consultar_asistencias_alumnos ($IdInstructor, $IdGrupo, $IdPlanMateria, $MesAsistencia, $AnioAsistencia) {
			try {
				$query = "EXEC spTraerAlumnosAsistenciasPorMateriaGrupoDocente ?, ?, ?, ?, ?";
				$result = $this->connection->connect_db()->prepare($query);
				$result->bindValue(1, $IdInstructor, PDO::PARAM_INT);
				$result->bindValue(2, $IdGrupo, PDO::PARAM_INT);
				$result->bindValue(3, $IdPlanMateria, PDO::PARAM_INT);
                $result->bindValue(4, $MesAsistencia, PDO::PARAM_STR|PDO::PARAM_NULL);
                $result->bindValue(5, $AnioAsistencia, PDO::PARAM_INT|PDO::PARAM_NULL);
				$result->execute();
					
				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}

		public function consultar_CatDia () {
			try {
				$query = "EXEC TRAER_CAT_DIA";
				$result = $this->connection->connect_db()->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$result->execute();
					
				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}

		public function consultar_CatNomenclaturaAsistencia () {
			try {
				$query = "EXEC spTraerCatNomenclaturaAsistencia";
				$result = $this->connection->connect_db()->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$result->execute();
					
				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}

		public function registrar_asistencias ($IdPersona, $IdAlumno, $IdAlumnoMatricula, $IdGrupo, $IdRelGrupoAlumno, $IdPlanMateria, 
		                                       $IdInstructor, $IdCicloEscolar, $IdCatDia, $Fecha_Asistencia, $IdCatNomenclaturaAsistencia, 
											   $IdUsuario) {
			try {
				$query = "EXEC spRegistrarAsistenciaAlumno ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
				$result = $this->connection->connect_db()->prepare($query);
				$result->bindValue(1, $IdPersona, PDO::PARAM_STR);
				$result->bindValue(2, $IdAlumno, PDO::PARAM_INT);
				$result->bindValue(3, $IdAlumnoMatricula, PDO::PARAM_INT);
				$result->bindValue(4, $IdGrupo, PDO::PARAM_INT);
				$result->bindValue(5, $IdRelGrupoAlumno, PDO::PARAM_INT);
				$result->bindValue(6, $IdPlanMateria, PDO::PARAM_INT);
				$result->bindValue(7, $IdInstructor, PDO::PARAM_INT);
				$result->bindValue(8, $IdCicloEscolar, PDO::PARAM_INT);
				$result->bindValue(9, $IdCatDia, PDO::PARAM_INT);
				$result->bindValue(10, $Fecha_Asistencia, PDO::PARAM_STR);
				$result->bindValue(11, $IdCatNomenclaturaAsistencia, PDO::PARAM_INT);
				$result->bindValue(12, $IdUsuario, PDO::PARAM_INT);
				$result->execute();
					
				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}

		public function actualizar_asistencias ($IdPersona, $IdAlumno, $IdAlumnoMatricula, $IdGrupo, $IdRelGrupoAlumno, $IdPlanMateria, 
		                                       $IdInstructor, $IdCicloEscolar, $IdCatDia, $Fecha_Asistencia, $IdCatNomenclaturaAsistencia, 
											   $IdUsuario) {
			try {
				$query = "EXEC spActualizarAsistenciaAlumno ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
				$result = $this->connection->connect_db()->prepare($query);
				$result->bindValue(1, $IdPersona, PDO::PARAM_STR);
				$result->bindValue(2, $IdAlumno, PDO::PARAM_INT);
				$result->bindValue(3, $IdAlumnoMatricula, PDO::PARAM_INT);
				$result->bindValue(4, $IdGrupo, PDO::PARAM_INT);
				$result->bindValue(5, $IdRelGrupoAlumno, PDO::PARAM_INT);
				$result->bindValue(6, $IdPlanMateria, PDO::PARAM_INT);
				$result->bindValue(7, $IdInstructor, PDO::PARAM_INT);
				$result->bindValue(8, $IdCicloEscolar, PDO::PARAM_INT);
				$result->bindValue(9, $IdCatDia, PDO::PARAM_INT);
				$result->bindValue(10, $Fecha_Asistencia, PDO::PARAM_STR);
				$result->bindValue(11, $IdCatNomenclaturaAsistencia, PDO::PARAM_INT);
				$result->bindValue(12, $IdUsuario, PDO::PARAM_INT);
				$result->execute();
					
				return $result;
			} catch(PDOException $exp) {
				return false;
			}
		}
	}

?>
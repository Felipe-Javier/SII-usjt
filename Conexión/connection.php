<?php

    class connection {
		//Establece los parametros de la conexion
		private $HOST = '172.21.88.149';
		private $USERNAME = 'MayraSalas';
		private $PASSWORD = 'Tam2021!';
		private $DB_NAME = 'USJT_20';
		private $PORT = '1433';
		public $CONN = false;

	  	public function __construct() {
		  	
	  	}

	  	public function connect_db() {
		  	try {
				$this->CONN = new PDO("sqlsrv:Server=$this->HOST,$this->PORT;Database=$this->DB_NAME",$this->USERNAME,$this->PASSWORD);
				$this->CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  //echo 'Se ha conectado correctamente a la base de datos: "'.$this->DB_NAME.'"';
		  	} catch (PDOException $exp) {
			  echo 'No se ha podido conectar a la base de datos: "'.$this->DB_NAME.'". '.$exp;
		  	}
			return $this->CONN;
    	}
  	}

?>
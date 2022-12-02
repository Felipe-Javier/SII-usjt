<?php

    class connection {
		    // -- SERVIDOR DE GOBIERNO --
		/*
		private $HOST = '172.21.88.149';
		private $USERNAME = 'MayraSalas';
		private $PASSWORD = 'Tam2021!';
		private $DB_NAME = 'USJT_20';
		*/

		    // -- SERVIDOR DE PRUEBA USJT --
		/*
		private $HOST = '10.8.155.252';
		private $USERNAME = 'prueba';
		private $PASSWORD = 'Usjt01';
		private $DB_NAME = 'USJT_20';
		*/

		    // -- SERVIDOR OFICIAL USJT --
		
		private $HOST = '10.8.155.251';
		private $USERNAME = 'DanielLerma';
		private $PASSWORD = 'daniel.01';
		private $DB_NAME = 'USJT_20';
		
		
		
		private $PORT = '1433';
		public $CONN = false;

	  	public function __construct() {
		  	
	  	}

	  	public function connect_db() {
		  	try {
				$this->CONN = new PDO("sqlsrv:Server=$this->HOST,$this->PORT;Database=$this->DB_NAME",$this->USERNAME,$this->PASSWORD);
				$this->CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				date_default_timezone_set('America/Monterrey');
			  //echo 'Se ha conectado correctamente a la base de datos: "'.$this->DB_NAME.'"';
		  	} catch (PDOException $exp) {
			  echo 'No se ha podido conectar a la base de datos: "'.$this->DB_NAME.'". '.$exp;
		  	}
			return $this->CONN;
    	}
  	}

?>
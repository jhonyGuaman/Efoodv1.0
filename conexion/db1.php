<?php
	class conexion
	{
		private $servidor;
		private $usuario;
		private $contraseña;
		private $basedatos;
		public  $conexion;

		public function __construct(){
			$this->servidor   = "localhost";
			$this->usuario	  = "postgres";
			$this->contraseña = "postgres";
			$this->basedatos  = "efood";

		}

		function conectar(){
			$this->conexion= new pgsql($this->servidor,$this->usuario,$this->contraseña,$this->basedatos);
		}

		function cerrar(){
			$this->conexion->close();
		}
	}

?>

<?php 
	/**
	* 
	*/
	class Conexao
	{
		
		private $serverName="localhost";
		private $userName="root";
		private $password="";
		private $database="market";
		
		public function getConnection(){
			$connection = new mysqli($this->serverName,$this->userName,$this->password,$this->database);
			if($connection->connect_error){
				die("Erro ao Conectar ".$connection->connect_error);
			}

			return $connection;
		}
	}

?>
<?php
	class Venda{
		private $idvendas;
		private $data;
		private $valor;
		private $idusuario;

		public function setIdvendas($idvendas){
			$this->idvendas = $idvendas;
		}

		public function getIdvendas(){
			return $this->idvendas;
		}

		public function setData($data){
			$this->data = $data;
		}

		public function getData(){
			return $this->data;
		}

		public function setValor($valor){
			$this->valor = $valor;
		}

		public function getValor(){
			return $this->valor;
		}

		public function setIdusuario($idusuario){
			$this->idusuario = $idusuario;
		}

		public function getIdusuario(){
			return $this->idusuario;
		}
	}
?>
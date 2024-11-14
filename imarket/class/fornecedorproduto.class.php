<?php
	class FornecedorProduto{
		private $idproduto;
		private $idfornecedor;

		public function setIdProduto($idproduto){
	    	$this->idproduto=$idproduto;
	    }
	    
	    public function getIdProduto(){
	    	return $this->idproduto;
	    }

		public function setIdfornecedor($idfornecedor){
			$this->idfornecedor=$idfornecedor;
		}

		public function getIdfornecedor(){
			return $this->idfornecedor;
		}
	}

?>
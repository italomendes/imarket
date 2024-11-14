<?php 
class VendaProduto{
	private $idvendas;
	private $idproduto;
	private $valor_unitario;
	private $valor_total;
	private $qtd_produto;

	public function setIdVendas($idvendas){
		$this->idvendas = $idvendas;
	}

	public function getIdVendas(){
		return $this->idvendas;
	}

	public function setIdproduto($idproduto){
		$this->idproduto = $idproduto;
	}

	public function getIdproduto(){
		return $this->idproduto;
	}

	public function setValor_total($valor_total){
		$this->valor_total = $valor_total;
	}

	public function getValor_total(){
		return $this->valor_total;
	}


	public function setValor_unitario($valor_unitario){
		$this->valor_unitario = $valor_unitario;
	}

	public function getValor_unitario(){
		return $this->valor_unitario;
	}

	public function setQtd_produto($qtd_produto){
		$this->qtd_produto = $qtd_produto;
	}

	public function getQtd_produto(){
		return $this->qtd_produto;
	}
}
?>
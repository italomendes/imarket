<?php
class Fornecedor{//inicio da classe
  private $idfornecedor;
  private $nome;
  private $cnpj;
  private $telefone;
  private $cep;
  private $endereco;

  public function setIdfornecedor($idfornecedor){
    $this->idfornecedor=$idfornecedor;
  }
  public function getIdfornecedor(){
    return $this->idfornecedor;
  }

  public function setNome($nome){
    $this->nome=$nome;
  }
  public function getNome(){
    return $this->nome;
  }
  
  public function setCnpj($cnpj){
    $this->cnpj=$cnpj;
  }

  public function getCnpj(){
    return $this->cnpj;
  }

  public function setTelefone($telefone){
    $this->telefone=$telefone;
  }

  public function getTelefone(){
    return $this->telefone;
  }

  public function setCep($cep){
    $this->cep=$cep;
  }

  public function getCep(){
    return $this->cep;
  }

  public function setEndereco($endereco){
    $this->endereco=$endereco;
  }

  public function getEndereco(){
    return $this->endereco;
  }
}
?>
        


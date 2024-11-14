<?php
class Produto{//inicio da classe
  private $idproduto;
  private $nome;
  private $descricao;
  private $categoria;
  private $data_add;
  private $data_val;
  private $valor;
  private $qndt_estoque;
  private $cod_barras;
  private $promo;
  private $img;
  private $quantidade;
  private $total;
  private $valfinal;

  public function setValfinal($valfinal){
    $this->valfinal = $valfinal;
  }

  public function getValfinal(){
    return $this->valfinal;
  }

  public function setTotal($total){
    $this->total = $total;
  }

  public function getTotal(){
    return $this->total;
  }

  public function setQuantidade($quantidade){
    $this->quantidade = $quantidade;
  }

  public function getQuantidade(){
    return $this->quantidade;
  }

  public function setPromo($promo){
    $this->promo = $promo;
  }

  public function getPromo(){
    return $this->promo;
  }

  public function setCategoria($categoria){
    $this->categoria=$categoria;
  }

  public function getCategoria(){
    return $this->categoria;
  }

  public function setDescricao($descricao){
    $this->descricao=$descricao;
  }

  public function getDescricao(){
    return $this->descricao;
  }

  public function setImg($img){
    $this->img=$img;
  }

  public function getImg(){
    return $this->img;
  }

  public function setIdProduto($idproduto){
    $this->idproduto=$idproduto;
  }
  public function getIdProduto(){
    return $this->idproduto;
  }

  public function setNome($nome){
    $this->nome=$nome;
  }
  public function getNome(){
    return $this->nome;
  }
  
  public function setData_add($data_add){
    $this->data_add=$data_add;
  }

  public function getData_add(){
    return $this->data_add;
  }

  public function setData_val($data_val){
    $this->data_val=$data_val;
  }

  public function getData_val(){
    return $this->data_val;
  }

  public function setValor($valor){
    $this->valor=$valor;
  }

  public function getValor(){
    return $this->valor;
  }

  public function setQndt_estoque($qndt_estoque){
    $this->qndt_estoque=$qndt_estoque;
  }

  public function getQndt_estoque(){
    return $this->qndt_estoque;
  }

  public function setCod_barras($cod_barras){
    $this->cod_barras=$cod_barras;
  }

  public function getCod_barras(){
    return $this->cod_barras;
  }
}
?>
        


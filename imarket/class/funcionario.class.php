<?php
class Funcionario{//inicio da classe
  private $idfuncionario;
  private $nome;
  private $cpf;
  private $endereco;
  private $cep;
  private $email;
  private $senha;
  private $cargo;
  private $data_nasc;
  private $sexo;
  private $telefone;
  private $administrador;

  public function setIdfuncionario($idfuncionario){
    $this->idfuncionario=$idfuncionario;
  }
  public function getIdfuncionario(){
    return $this->idfuncionario;
  }

  public function setNome($nome){
    $this->nome=$nome;
  }
  public function getNome(){
    return $this->nome;
  }
  
  public function setCpf($cpf){
    $this->cpf=$cpf;
  }

  public function getCpf(){
    return $this->cpf;
  }

  public function setEndereco($endereco){
    $this->endereco=$endereco;
  }

  public function getEndereco(){
    return $this->endereco;
  }

  public function setCep($cep){
    $this->cep=$cep;
  }

  public function getCep(){
    return $this->cep;
  }

  public function setEmail($email){
    $this->email=$email;
  }

  public function getEmail(){
    return $this->email;
  }

  public function setSenha($senha){
    $this->senha=$senha;
  }

  public function getSenha(){
    return $this->senha;
  }

  public function setCargo($cargo){
    $this->cargo=$cargo;
  }

  public function getCargo(){
    return $this->cargo;
  }

  public function setData_nasc($data_nasc){
    $this->data_nasc=$data_nasc;
  }

  public function getData_nasc(){
    return $this->data_nasc;
  }

  public function setSexo($sexo){
    $this->sexo=$sexo;
  }

  public function getSexo(){
    return $this->sexo;
  }

  public function setTelefone($telefone){
    $this->telefone=$telefone;
  }

  public function getTelefone(){
    return $this->telefone;
  }

  public function setAdministrador($administrador){
    $this->administrador=$administrador;
  }

  public function getAdministrador(){
    return $this->administrador;
  }

}//fim da classe

/*$u = new Usuario();
$u->setNome("Monara campos nogueira");
echo $u->getNome();

$u = new Usuario();
$u->setEmail("monara@gmail.com");
echo $u->getEmail();

$u = new Usuario();
$u->setNivel("Nivel 08");
echo $u->getNivel();
*/
?>
        


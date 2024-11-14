<?php
require_once 'class/funcionario.class.php';
require_once 'class/conexao.class.php';
/**
*
*/
class DaoFuncionario{
	private $serverName="localhost";
	private $username="root";
	private $password="";
	private $database="market";

	public function save($funcionario){
		$verificador = true;

		$sql = "INSERT INTO `funcionario`(`nome`, `cpf`, `endereco`, `cep`, `email`, `senha`, `cargo`, `data_nasc`, `sexo`, `telefone`, `administrador`) VALUES(?,?,?,?,?,?,?,?,?,?,?)";

		//faz a conexão com o banco de dados
		$con = new mysqli($this->serverName,$this->username,$this->password,$this->database);
		if ($con->connect_error) {
			$verificador = false;
			die("Falha ao conectar".$con->connect_error);
		}

		$stmt = $con->prepare($sql);

		$stmt->bind_param('sssssssssss',$nome,$cpf,$endereco,$cep,$email,$senha,$cargo,$data_nasc,$sexo,$telefone,$administrador);

		$nome = $funcionario->getNome();
		$cpf = $funcionario->getCpf();
		$endereco = $funcionario->getEndereco();
		$cep = $funcionario->getCep();
		$email = $funcionario->getEmail();
		$senha = md5($funcionario->getSenha());
		$cargo = $funcionario->getCargo();
		$data_nasc = $funcionario->getData_nasc();
		$sexo = $funcionario->getSexo();
		$telefone = $funcionario->getTelefone();
		$administrador = $funcionario->getAdministrador();

		$stmt->execute();

		$stmt->close();

		$con->close();
		return $verificador;
	}

	public function login($email){
		$sql = "SELECT * FROM  `funcionario` WHERE `email` LIKE '".$email."'";

		$conexao = new mysqli($this->serverName,$this->username,$this->password,$this->database);

		if ($conexao->connect_error) {
			die("Erro ao Conectar: ".$conexao->connect_error);
		}

		$result = $conexao->query($sql); // result é uma matriz
		$funcionario = NULL;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$funcionario = new Funcionario();
				$funcionario->setIdfuncionario($row['idfuncionario']);
				$funcionario->setNome($row['nome']);
				$funcionario->setCpf($row['cpf']);
				$funcionario->setEndereco($row['endereco']);
				$funcionario->setCep($row['cep']);
				$funcionario->setEmail($row['email']);
				$funcionario->setSenha($row['senha']);
				$funcionario->setCargo($row['cargo']);
				$funcionario->setData_nasc($row['data_nasc']);
				$funcionario->setSexo($row['sexo']);
				$funcionario->setTelefone($row['telefone']);
				$funcionario->setAdministrador($row['administrador']);
			}
		}
		$conexao->close();
		return $funcionario;
	}

		public function getFuncionario($codigo){
		$sql = "SELECT * FROM  `funcionario` WHERE `idfuncionario`= ".$codigo;

		$conexao = new mysqli($this->serverName,$this->username,$this->password,$this->database);

		if ($conexao->connect_error) {
			die("Erro ao Conectar: ".$conexao->connect_error);
		}

		$result = $conexao->query($sql); // result é uma matriz
		$funcionario = NULL;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$funcionario = new Funcionario();
				$funcionario->setIdfuncionario($row['idfuncionario']);
				$funcionario->setNome($row['nome']);
				$funcionario->setCpf($row['cpf']);
				$funcionario->setEndereco($row['endereco']);
				$funcionario->setCep($row['cep']);
				$funcionario->setEmail($row['email']);
				$funcionario->setSenha($row['senha']);
				$funcionario->setCargo($row['cargo']);
				$funcionario->setData_nasc($row['data_nasc']);
				$funcionario->setSexo($row['sexo']);
				$funcionario->setTelefone($row['telefone']);
				$funcionario->setAdministrador($row['administrador']);
			}
		}
		$conexao->close();
		return $funcionario;
	}

	//pesquisar
	public function getAll(){
			$resultado = null;
			//$conexao = new Conexao();
			//$con = $conexao->getConnection();

			$sql = "SELECT * FROM `funcionario`  ORDER BY `email` ASC";

			$con = new mysqli($this->serverName,$this->username,$this->password,$this->database);
			if ($con->connect_error) {
				$verificador = false;
				die("Falha ao conectar".$con->connect_error);
			}

			$stmt = $con->prepare($sql);
			$result  = $con->query($sql);

			if($result->num_rows > 0 ){
				$resultado = array();
				while($row = $result->fetch_assoc()){
					$funcionario = new Funcionario();
					$funcionario->setIdfuncionario($row['idfuncionario']);
					$funcionario->setNome($row['nome']);
					$funcionario->setCpf($row['cpf']);
					$funcionario->setEndereco($row['endereco']);
					$funcionario->setCep($row['cep']);
					$funcionario->setEmail($row['email']);
					$funcionario->setSenha($row['senha']);
					$funcionario->setCargo($row['cargo']);
					$funcionario->setData_nasc($row['data_nasc']);
					$funcionario->setSexo($row['sexo']);
					$funcionario->setTelefone($row['telefone']);;
					$funcionario->setAdministrador($row['administrador']);

					array_push($resultado, $funcionario);
				}
			}

			return $resultado;
		}

		public function update($funcionario){
			$conexao = new Conexao();
			$con = $conexao->getConnection();

			$sql = "UPDATE `funcionario` SET `nome` = '".$funcionario->getNome()."', `cpf` = '".$funcionario->getCpf()."', `endereco` = '".$funcionario->getEndereco()."', `cep` = '".$funcionario->getCep()."', `email` = '".$funcionario->getEmail()."', `senha` = '".md5($funcionario->getSenha())."', `cargo` = '".$funcionario->getCargo()."', `data_nasc` = '".$funcionario->getData_nasc()."', `sexo` = '".$funcionario->getSexo()."', `telefone` = '".$funcionario->getTelefone()."',`administrador` = '".$funcionario->getAdministrador()."' WHERE `idfuncionario` = ".$_GET['codigo'];
			echo $sql;
			if ($con->query($sql) == TRUE) {
				echo "<script> alert('Alterado com sucesso') </script>";
				echo "<script> window.location.href='http://localhost/projetonovo/funcionarios.php'</script>";
			}else{
				echo "<script> alert('Erro ao alterar')</script>";
			}

			$con->close();
		}

		public function delete($funcionario){
			$conexao = new Conexao();
			$con = $conexao->getConnection();

			$sql = "DELETE FROM `funcionario` WHERE `idfuncionario` = ".$funcionario->getIdfuncionario();

			if ($con->query($sql) == TRUE) {
				echo "<script> alert('Deletado com sucesso') </script>";
				echo "<script> window.location.href='http://localhost/projetonovo/funcionarios.php'</script>";
			}else{
				echo "<script> alert('Erro ao deletar')</script>";
			}

			$con->close();
		}

}
?>
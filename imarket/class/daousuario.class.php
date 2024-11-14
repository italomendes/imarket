<?php
require_once 'class/usuario.class.php';
require_once 'class/conexao.class.php';
/**
*
*/
class DaoUsuario{
	private $serverName="localhost";
	private $username="root";
	private $password="";
	private $database="market";

	public function save($usuario){
		$verificador = true;

		$sql = "INSERT INTO `usuario`(`nome`, `cpf`, `endereco`, `cep`, `email`, `senha`, `data_nasc`, `sexo`, `telefone`) VALUES(?,?,?,?,?,?,?,?,?)";

		//faz a conexão com o banco de dados
		$con = new mysqli($this->serverName,$this->username,$this->password,$this->database);
		if ($con->connect_error) {
			$verificador = false;
			die("Falha ao conectar".$con->connect_error);
		}

		$stmt = $con->prepare($sql);

		$stmt->bind_param('sssssssss',$nome,$cpf,$endereco,$cep,$email,$senha,$data_nasc,$sexo,$telefone);

		$nome = $usuario->getNome();
		$cpf = $usuario->getCpf();
		$endereco = $usuario->getEndereco();
		$cep = $usuario->getCep();
		$email = $usuario->getEmail();
		$senha = md5($usuario->getSenha());
		$data_nasc = $usuario->getData_nasc();
		$sexo = $usuario->getSexo();
		$telefone = $usuario->getTelefone();

		$stmt->execute();

		$stmt->close();

		$con->close();
		return $verificador;
	}

	public function login($email){
		$sql = "SELECT * FROM  `usuario` WHERE `email` LIKE '".$email."'";

		$conexao = new mysqli($this->serverName,$this->username,$this->password,$this->database);

		if ($conexao->connect_error) {
			die("Erro ao Conectar: ".$conexao->connect_error);
		}

		$result = $conexao->query($sql); // result é uma matriz
		$usuario = NULL;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$usuario = new Usuario();
				$usuario->setIdusuario($row['idusuario']);
				$usuario->setNome($row['nome']);
				$usuario->setCpf($row['cpf']);
				$usuario->setEndereco($row['endereco']);
				$usuario->setCep($row['cep']);
				$usuario->setEmail($row['email']);
				$usuario->setSenha($row['senha']);
				$usuario->setData_nasc($row['data_nasc']);
				$usuario->setSexo($row['sexo']);
				$usuario->setTelefone($row['telefone']);;
			}
		}
		$conexao->close();
		return $usuario;
	}

	public function getUsuario($codigo){
		$sql = "SELECT * FROM  `usuario` WHERE `idusuario`= ".$codigo;

		$conexao = new mysqli($this->serverName,$this->username,$this->password,$this->database);

		if ($conexao->connect_error) {
			die("Erro ao Conectar: ".$conexao->connect_error);
		}

		$result = $conexao->query($sql); // result é uma matriz
		$usuario = NULL;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$usuario = new Usuario();
				$usuario->setIdusuario($row['idusuario']);
				$usuario->setNome($row['nome']);
				$usuario->setCpf($row['cpf']);
				$usuario->setEndereco($row['endereco']);
				$usuario->setCep($row['cep']);
				$usuario->setEmail($row['email']);
				$usuario->setSenha($row['senha']);
				$usuario->setData_nasc($row['data_nasc']);
				$usuario->setSexo($row['sexo']);
				$usuario->setTelefone($row['telefone']);
			}
		}
		$conexao->close();
		return $usuario;
	}

	//pesquisar
	public function getAll(){
		$resultado = null;
		//$conexao = new Conexao();
		//$con = $conexao->getConnection();

		$sql = "SELECT * FROM `usuario`  ORDER BY `email` ASC";

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
				$usuario = new Usuario();
				$usuario->setIdusuario($row['idusuario']);
				$usuario->setNome($row['nome']);
				$usuario->setCpf($row['cpf']);
				$usuario->setEndereco($row['endereco']);
				$usuario->setCep($row['cep']);
				$usuario->setEmail($row['email']);
				$usuario->setSenha($row['senha']);
				$usuario->setData_nasc($row['data_nasc']);
				$usuario->setSexo($row['sexo']);
				$usuario->setTelefone($row['telefone']);;

				array_push($resultado, $usuario);
			}
		}

		return $resultado;
	}

	public function update($usuario){
		$conexao = new Conexao();
		$con = $conexao->getConnection();

		$sql = "UPDATE `usuario` SET `nome` = '".$usuario->getNome()."', `cpf` = '".$usuario->getCpf()."', `endereco` = '".$usuario->getEndereco()."', `cep` = '".$usuario->getCep()."', `email` = '".$usuario->getEmail()."', `senha` = '".md5($usuario->getSenha())."', `data_nasc` = '".$usuario->getData_nasc()."', `sexo` = '".$usuario->getSexo()."', `telefone` = '".$usuario->getTelefone()."' WHERE `idusuario` = ".$_GET['codigo'];
			echo $sql;
		if ($con->query($sql) == TRUE) {
			echo "<script> alert('Alterado com sucesso') </script>";
			echo "<script> window.location.href='http://localhost/projetonovo/usuarios.php'</script>";
		}else{
			echo "<script> alert('Erro ao alterar')</script>";
		}

		$con->close();
	}

	public function delete($usuario){
			$conexao = new Conexao();
			$con = $conexao->getConnection();

			$sql = "DELETE FROM `usuario` WHERE `idusuario` = ".$usuario->getIdusuario();

			if ($con->query($sql) == TRUE) {
				echo "<script> alert('Deletado com sucesso') </script>";
				echo "<script> window.location.href='http://localhost/projetonovo/usuarios.php'</script>";
			}else{
				echo "<script> alert('Erro ao deletar')</script>";
			}

			$con->close();
		}
}
?>
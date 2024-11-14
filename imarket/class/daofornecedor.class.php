<?php
require_once 'class/fornecedor.class.php';
require_once 'class/conexao.class.php';
/**
*
*/
class DaoFornecedor{
	private $serverName="localhost";
	private $username="root";
	private $password="";
	private $database="market";

	public function save($fornecedor){
		$verificador = true;

		$sql = "INSERT INTO `fornecedor`(`nome`, `cnpj`, `telefone`, `cep`, `endereco`) VALUES(?,?,?,?,?)";

		//faz a conexão com o banco de dados
		$con = new mysqli($this->serverName,$this->username,$this->password,$this->database);
		if ($con->connect_error) {
			$verificador = false;
			die("Falha ao conectar".$con->connect_error);
		}

		$stmt = $con->prepare($sql);

		$stmt->bind_param('sssss',$nome,$cnpj,$telefone,$cep,$endereco);

		$nome = $fornecedor->getNome();
		$cnpj = $fornecedor->getCnpj();
		$telefone = $fornecedor->getTelefone();
		$cep = $fornecedor->getCep();
		$endereco = $fornecedor->getEndereco();

		$stmt->execute();

		$stmt->close();

		$con->close();
		return $verificador;
	}


		public function getFornecedor($codigo){
		$sql = "SELECT * FROM  `fornecedor` WHERE `idfornecedor`= ".$codigo;

		$conexao = new mysqli($this->serverName,$this->username,$this->password,$this->database);

		if ($conexao->connect_error) {
			die("Erro ao Conectar: ".$conexao->connect_error);
		}

		$result = $conexao->query($sql); // result é uma matriz
		$fornecedor = NULL;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$fornecedor = new Fornecedor();
				$fornecedor->setIdfornecedor($row['idfornecedor']);
				$fornecedor->setNome($row['nome']);
				$fornecedor->setCnpj($row['cnpj']);
				$fornecedor->setTelefone($row['telefone']);
				$fornecedor->setCep($row['cep']);
				$fornecedor->setEndereco($row['endereco']);
			
			}
		}
		$conexao->close();
		return $fornecedor;
	}

	//pesquisar
	public function getAll(){
			$resultado = null;
			//$conexao = new Conexao();
			//$con = $conexao->getConnection();

			$sql = "SELECT * FROM `fornecedor`  ORDER BY `nome` ASC";

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
					$fornecedor = new Fornecedor();
					$fornecedor->setIdfornecedor($row['idfornecedor']);
					$fornecedor->setNome($row['nome']);
					$fornecedor->setCnpj($row['cnpj']);
					$fornecedor->setTelefone($row['telefone']);
					$fornecedor->setCep($row['cep']);
					$fornecedor->setEndereco($row['endereco']);

					array_push($resultado, $fornecedor);
				}
			}

			return $resultado;
		}

		public function getAllFornecedores(){
			$resultado = null;
			//$conexao = new Conexao();
			//$con = $conexao->getConnection();

			$sql = "SELECT * FROM `fornecedor`  ORDER BY `nome` ASC";

			$con = new mysqli($this->serverName,$this->username,$this->password,$this->database);
			if ($con->connect_error) {
				$verificador = false;
				die("Falha ao conectar".$con->connect_error);
			}

			$stmt = $con->prepare($sql);
			$result  = $con->query($sql);
			$array = array();

			if($result->num_rows > 0 ){
				$resultado = array();
				while($row = $result->fetch_assoc()){
					$fornecedor = new Fornecedor();
					$fornecedor->setIdfornecedor($row['idfornecedor']);
					$fornecedor->setNome($row['nome']);
					$fornecedor->setCnpj($row['cnpj']);
					$fornecedor->setTelefone($row['telefone']);
					$fornecedor->setCep($row['cep']);
					$fornecedor->setEndereco($row['endereco']);

					array_push($array, $fornecedor);
				}
			}

			return $array;
		}

		public function update($fornecedor){
			$conexao = new Conexao();
			$con = $conexao->getConnection();

			$sql = "UPDATE `fornecedor` SET `nome` = '".$fornecedor->getNome()."', `cnpj` = '".$fornecedor->getCnpj()."', `telefone` = '".$fornecedor->getTelefone()."', `cep` = '".$fornecedor->getCep()."', `endereco` = '".$fornecedor->getEndereco()."' WHERE `idfornecedor` = ".$_GET['codigo'];
			echo $sql;
			if ($con->query($sql) == TRUE) {
				echo "<script> alert('Alterado com sucesso') </script>";
				echo "<script> window.location.href='http://localhost/projetonovo/fornecedores.php'</script>";
			}else{
				echo "<script> alert('Erro ao alterar')</script>";
			}

			$con->close();
		}

		public function delete($fornecedor){
			$conexao = new Conexao();
			$con = $conexao->getConnection();

			$sql = "DELETE FROM `fornecedor` WHERE `idfornecedor` = ".$fornecedor->getIdfornecedor();

			if ($con->query($sql) == TRUE) {
				echo "<script> alert('Deletado com sucesso') </script>";
				echo "<script> window.location.href='http://localhost/projetonovo/fornecedores.php'</script>";
			}else{
				echo "<script> alert('Erro ao deletar')</script>";
			}

			$con->close();
		}

}
?>
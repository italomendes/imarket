<?php
require_once 'class/produto.class.php';
require_once 'class/conexao.class.php';
/**
*
*/
class DaoProduto{
	private $serverName="localhost";
	private $username="root";
	private $password="";
	private $database="market";

	public function save($produto){
		$verificador = true;

		$sql = "INSERT INTO `produto`(`nome`,`descricao`,`categoria`, `data_add`, `data_val`, `valor`, `qndt_estoque`, `cod_barras`, `promo`, `img`) VALUES(?,?,?,NOW(),?,?,?,?,?,?)";

		//faz a conexão com o banco de dados
		$con = new mysqli($this->serverName,$this->username,$this->password,$this->database);
		if ($con->connect_error) {
			$verificador = false;
			die("Falha ao conectar".$con->connect_error);
		}

		$stmt = $con->prepare($sql);

		$stmt->bind_param('ssisdssis',$nome,$descricao,$categoria,$data_val,$valor,$qndt_estoque,$cod_barras,$promo,$img);

		$nome = $produto->getNome();
		$descricao = $produto->getDescricao();
		$categoria = $produto->getCategoria();
		//$data_add = $produto->getData_add();
		$data_val = $produto->getData_val();
		$valor = $produto->getValor();
		$qndt_estoque = $produto->getQndt_estoque();
		$cod_barras = $produto->getCod_barras();
		$promo = $produto->getPromo();
		$img = $produto->getImg();

		$stmt->execute();

		$stmt->close();

		$con->close();
		return $verificador;
	}


		public function getProduto($codigo){
		$sql = "SELECT * FROM  `produto` WHERE `idproduto`= ".$codigo;

		$conexao = new mysqli($this->serverName,$this->username,$this->password,$this->database);

		if ($conexao->connect_error) {
			die("Erro ao Conectar: ".$conexao->connect_error);
		}

		$result = $conexao->query($sql); // result é uma matriz
		$produto = NULL;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$produto = new Produto();
				$produto->setIdproduto($row['idproduto']);
				$produto->setNome($row['nome']);
				$produto->setDescricao($row['descricao']);
				$produto->setCategoria($row['categoria']);
				$produto->setData_add($row['data_add']);
				$produto->setData_val($row['data_val']);
				$produto->setValor($row['valor']);
				$produto->setQndt_estoque($row['qndt_estoque']);
				$produto->setCod_barras($row['cod_barras']);
				$produto->setPromo($row['promo']);
				$produto->setImg($row['img']);
			}
		}
		$conexao->close();
		return $produto;
	}

	//pesquisar
	public function getAll(){
			$resultado = null;
			//$conexao = new Conexao();
			//$con = $conexao->getConnection();

			$sql = "SELECT * FROM `produto`  ORDER BY `nome` ASC";

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
					$produto = new Produto();
					$produto->setIdproduto($row['idproduto']);
					$produto->setNome($row['nome']);
					$produto->setDescricao($row['descricao']);
					$produto->setCategoria($row['categoria']);
					$produto->setData_add($row['data_add']);
					$produto->setData_val($row['data_val']);
					$produto->setValor($row['valor']);
					$produto->setQndt_estoque($row['qndt_estoque']);
					$produto->setCod_barras($row['cod_barras']);
					$produto->setPromo($row['promo']);
					$produto->setImg($row['img']);

					array_push($resultado, $produto);
				}
			}

			return $resultado;
		}

		public function update($produto){
			$conexao = new Conexao();
			$con = $conexao->getConnection();

			$sql = "UPDATE `produto` SET `nome` = '".$produto->getNome()."', `descricao` = '".$produto->getDescricao()."', `categoria` = '".$produto->getCategoria()."', `data_val` = '".$produto->getData_val()."', `valor` = '".$produto->getValor()."', `qndt_estoque` = '".$produto->getQndt_estoque()."',  `cod_barras` = '".$produto->getCod_barras()."', `promo` = '".$produto->getPromo()."', `img` = '".$produto->getImg()."' WHERE `idproduto` = ".$_GET['codigo'];
			//echo $sql;
			if ($con->query($sql) == TRUE) {
				echo "<script> alert('Alterado com sucesso') </script>";
				echo "<script> window.location.href='http://localhost/projetonovo/produtos.php'</script>";
			}else{
				echo "<script> alert('Erro ao alterar')</script>";
			}

			$con->close();
		}

		public function delete($produto){
			$conexao = new Conexao();
			$con = $conexao->getConnection();

			$sql = "DELETE FROM `produto` WHERE `idproduto` = ".$produto->getIdproduto();

			if ($con->query($sql) == TRUE) {
				echo "<script> alert('Deletado com sucesso') </script>";
				echo "<script> window.location.href='http://localhost/projetonovo/produtos.php'</script>";
			}else{
				echo "<script> alert('Erro ao deletar')</script>";
			}

			$con->close();
		}

		//pesquisar por categoria
	public function getCategoria($codigo){
		$sql = "SELECT * FROM  `produto` WHERE `categoria` = ".$codigo;

		$con = new mysqli($this->serverName,$this->username,$this->password,$this->database);

		if ($con->connect_error) {
			die("Erro ao Conectar: ".$con->connect_error);
		}

		$stmt = $con->prepare($sql);
		$result  = $con->query($sql);
		if($result->num_rows > 0 ){
				$resultado = array();
				while($row = $result->fetch_assoc()){
					$produto = new Produto();
					$produto->setIdproduto($row['idproduto']);
					$produto->setNome($row['nome']);
					$produto->setDescricao($row['descricao']);
					$produto->setCategoria($row['categoria']);
					$produto->setData_add($row['data_add']);
					$produto->setData_val($row['data_val']);
					$produto->setValor($row['valor']);
					$produto->setQndt_estoque($row['qndt_estoque']);
					$produto->setCod_barras($row['cod_barras']);
					$produto->setPromo($row['promo']);
					$produto->setImg($row['img']);

					array_push($resultado, $produto);
				}
			}
			$con->close();
			return $resultado;
	}

	public function getPromo($promo){
		$sql = "SELECT * FROM  `produto` WHERE `promo` = ".$promo;

		$con = new mysqli($this->serverName,$this->username,$this->password,$this->database);

		if ($con->connect_error) {
			die("Erro ao Conectar: ".$con->connect_error);
		}

		$stmt = $con->prepare($sql);
		$result  = $con->query($sql);
		if($result->num_rows > 0 ){
				$resultado = array();
				while($row = $result->fetch_assoc()){
					$produto = new Produto();
					$produto->setIdproduto($row['idproduto']);
					$produto->setNome($row['nome']);
					$produto->setDescricao($row['descricao']);
					$produto->setCategoria($row['categoria']);
					$produto->setData_add($row['data_add']);
					$produto->setData_val($row['data_val']);
					$produto->setValor($row['valor']);
					$produto->setQndt_estoque($row['qndt_estoque']);
					$produto->setCod_barras($row['cod_barras']);
					$produto->setPromo($row['promo']);
					$produto->setImg($row['img']);

					array_push($resultado, $produto);
				}
			}
			$con->close();
			return $resultado;
	}

}
?>
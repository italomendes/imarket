<?php
	require_once 'class/venda.class.php';
	require_once 'class/usuario.class.php';
	require_once 'class/conexao.class.php';
	require_once 'class/produto.class.php';
	require_once 'class/vendaproduto.class.php';

	class DaoVenda{
		public function save($usuario,$itens,$venda){
			$conexao = new Conexao();
			$con = $conexao->getConnection();

			$sql = "INSERT INTO `vendas`(`data`,`valor`,`idusuario`) VALUES (NOW(),?,?)";
			$stmt = $con->prepare($sql);

			$stmt->bind_param('di',$valor,$idusuario);
			$valor = $venda->getValor();
			$idusuario = $usuario->getIdusuario();
			$stmt->execute();

			$id_venda = $con->insert_id;

			$sql = "INSERT INTO `vendas_produto`(`idvendas`, `idproduto`, `valor_unitario`, `valor_total`, `qtd_produto`) VALUES(?,?,?,?,?)";

			$stmt = $con->prepare($sql);
			$stmt->bind_param('iidds',$idvendas,$idproduto,$valor_unitario,$valor_total,$qtd_produto);

			$vendaproduto = new VendaProduto();
			foreach ($itens as $key => $value) {
				# code...
				 $produto = unserialize($value);

				 $idvendas = $id_venda;
				 $idproduto = $produto->getIdProduto();
				 $valor_unitario = $produto->getValor();
				 $valor_total = $produto->getTotal();
				 $qtd_produto = $produto->getQuantidade();

				 if($stmt->execute()){
				 	echo "<script>alert('Compra realizada com sucesso! Verifique a área compras na sua conta')</script>";
                    unset($_SESSION['itens']);
                    echo "<script>window.location.href='http://localhost/projetonovo/conta.php'</script>";
				 }
			}


			$stmt->close();
			$con->close();
	}

	public function getCompra($idusuario){
		$conexao = new Conexao();
		$con = $conexao->getConnection();

		$sql = "SELECT * FROM `vendas` WHERE `idusuario`=".$idusuario;

		if ($con->connect_error) {
			$verificador = false;
			die("Falha ao conectar".$con->connect_error);
		}

		$stmt = $con->prepare($sql);
		$result  = $con->query($sql);

		if($result->num_rows > 0 ){
			$resultado = array();
			while($row = $result->fetch_assoc()){
				$venda = new Venda();
				$venda->setIdvendas($row['idvendas']);
				$venda->setData($row['data']);
				$venda->setValor($row['valor']);
				$venda->setIdusuario($row['idusuario']);

				array_push($resultado, $venda);
			}
		}


		return $resultado;
	}

	public function getItens($idvendas){
		$conexao = new Conexao();
		$con = $conexao->getConnection();

		$sql = "SELECT * FROM `vendas_produto` WHERE `idvendas`=".$idvendas;

		if ($con->connect_error) {
			$verificador = false;
			die("Falha ao conectar".$con->connect_error);	
		}

		$stmt = $con->prepare($sql);
		$result = $con->query($sql);

		if ($result->num_rows > 0) {
			$resultado = array();
			while ($row = $result->fetch_assoc()) {
				$vendaproduto = new VendaProduto();
				$vendaproduto->setIdvendas($row['idvendas']);
				$vendaproduto->setIdproduto($row['idproduto']);
				$vendaproduto->setValor_unitario($row['valor_unitario']);
				$vendaproduto->setValor_total($row['valor_total']);
				$vendaproduto->setQtd_produto($row['qtd_produto']);

				array_push($resultado, $vendaproduto);
			}
		}

		return $resultado;
	}

	public function mail(){
		
	}
}
?>
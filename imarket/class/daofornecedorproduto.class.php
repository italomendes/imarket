<?php
	require_once 'class/fornecedorproduto.class.php';
	require_once 'class/conexao.class.php';

	class DaoFornecedorProduto{
		public function save($fornecedorproduto){
			
			$conexao = new Conexao();
			$con = $conexao->getConnection();
			$sql = "INSERT INTO `produto_fornecedor`(`idproduto`,`idfornecedor`) VALUES (?,?)";

			$stmt = $con->prepare($sql);

			$stmt->bind_param('ii',$idproduto,$idfornecedor);

			$idproduto = $fornecedorproduto->getIdproduto();
			$idfornecedor = $fornecedorproduto->getIdfornecedor();

			$stmt->execute();
			$stmt->close();

			$con->close();
		}
	}
	

?>
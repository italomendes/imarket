<?php
	require_once "daocliente.class.php";
  require_once "daoendereco.class.php";
	if (isset($_GET['codigo'])) {
		$dao = new daoCliente();
    $cliente = $dao->getCliente($_GET['codigo']);

    $daoEndereco = new DaoEndereco();
    $arrayEndereco = $daoEndereco->getAllEnderecos();
		//var_dump($dao->getCliente($_GET['codigo']));
	}

  //  session_start();

	//$dao  = new DaoEndereco();

	//$arrayEndereco = $dao->getAllEnderecos();
?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>

    <script type="text/javascript">
    	  $(document).ready(function() {
    		$('select').material_select();
  		  });
    </script>
      <div class="row"> 
      <div class="col s12 ">
      	<form class="card-panel" method="POST">
      		<div class="row">
      			<div class="col s5  input-field">
      				<input type="text" name="nome" id="nome" value="<?php echo $cliente->getNome(); ?>">
      				<label for="nome">Nome</label>
      			</div>
      		</div>
      		<div class="row">
      			<div class="col s5 input-field"> 
      				<input type="text" name="telefone" id="telefone" value="<?php echo $cliente->getTelefone() ?>">
      				<label for="telefone">Telefone</label>
      			</div>
      		</div>
      		<div class="row"> 
      		<div class="col s5 input-field">
      			<select name="endereco">
      				<?php
      					foreach($arrayEndereco as $endereco){
      						echo "<option value =".$endereco->getIdEndereco()." ".(($endereco->getIdEndereco() == $cliente->getEndereco()->getIdEndereco())? "selected" : "")."> ".$endereco->getLogradouro()." - ".$endereco->getNome()."   ".$endereco->getNumero();
                  echo "</option>";
      					}
      				?>
      			</select>
      		</div>
      		</div>
          <div class="row">
            <div class="col s6 center">
              <button name="submit" type="submit" class="btn waves-effect waves-light " > Alterar <i class="material-icons right">send</i></button>
            </div>
          </div>
          <?php 
            if (isset($_POST['submit'])) {
              $cliente->setNome($_POST['nome']);
              $cliente->setTelefone($_POST['telefone']);
              $cliente->setEndereco($_POST['endereco']);

              $dao->update($cliente);
            }
          ?>
      	</form>
      </div>
      </div>
      
    </body>
  </html>
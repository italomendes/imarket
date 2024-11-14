  <?php
    require_once 'class/fornecedor.class.php';
    require_once 'class/daofornecedor.class.php';
    require_once 'class/funcionario.class.php';
    require_once 'class/daofuncionario.class.php';
    session_start();
    if (isset($_SESSION['funcionario'])) {
      $funcionario = $_SESSION['funcionario'];
      //var_dump($funcionario);
    }else{
      echo "<script> window.location.href='http://localhost/projetonovo/loginadm.php'</script>";
    }

    if ($funcionario->getAdministrador()==0) {
      echo "<script> alert('Você não é um administrador')</script>";
      echo "<script> window.location.href='http://localhost/projetonovo/conta.php'</script>";
    }
    if (isset($_GET['codigo'])) {
      $dao = new daoFornecedor();
      $fornecedor = $dao->getFornecedor($_GET['codigo']);
      //var_dump($dao->getFuncionario($_GET['codigo']));
      //$daoEndereco = new DaoEndereco();
      //$arrayEndereco = $daoEndereco->getAllEnderecos();       
    } 
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
      <link type="text/css" rel="stylesheet" href="css/new.css"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
      <script type="text/javascript">
          $(document).ready(function() {
          $('select').material_select();
        });         
      </script>
      <!--Background -->
      <div class="row ">
        <div id="fundo-externo">
          <div id="fundo">
            <img src="img/mercado.png" alt="" />
          </div>
        </div>
        <!--Começo do corpo -->
        <div class="row ">
          <div class=" col s10 offset-s1 card-panel  ">
            <nav> <!--NavBar superior -->
              <div class="collection nav-wrapper grey darken-3">
                <a href="index.php" class="brand-logo"><img class="left" width="50px" height="50px" src="img/logo.png">iMarket</a>
              </div>
            </nav>
            
            <div class="row ">

            
              

            <!--Começo do conteúdo -->
            <div class="row collection transparent""> 
              <div class="">
                <div class="col s12 white darken-1">
                  <h3 class="center">Deletar funcionário</h3>
                  <form class="card-panel col s8 offset-s2 z-depth-5" method="POST">
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="nome" id="nome" value="<?php echo $fornecedor->getNome(); ?>" disabled>
                        <label for="nome">Nome</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="cnpj" id="cnpj" value="<?php echo $fornecedor->getCnpj(); ?>" disabled>
                        <label for="cnpj">CNPJ</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="telefone" id="telefone" value="<?php echo $fornecedor->getTelefone(); ?>" disabled>
                        <label for="telefone">Telefone</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="cep" id="cep" value="<?php echo $fornecedor->getCep(); ?>" disabled> 
                        <label for="cep">Cep</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="endereco" id="endereco" value="<?php echo $fornecedor->getEndereco(); ?>" disabled>
                        <label for="endereco">Endereço</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 center">
                        <button class="btn waves-effect grey darken-3" type="submit" name="submit"><i class="material-icons right">delete</i>Deletar</button>
                      </div>
                    </div>
                </div>
                </form> 
                <?php
                  if(isset($_POST['submit'])){
                    $dao->delete($fornecedor);
                  }
                ?> 
                </div> 
              </div>                
            </div>
            <nav class="collection"><!--Rodapé -->
              <div class="nav row col s12 grey darken-3">
                <div class="col s10"> © Copyright 2016-2017 italomemendes@gmail.com - All Rights Reserved - Legal</div>
                <div class="col s2 right"><a href="administracao.php" class="right">Administração</a></div>
              </div>
            </nav>
          </div>
        </div><!--Fim do corpo -->
      </div> 

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
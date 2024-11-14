<?php
require_once 'class/funcionario.class.php';
require_once 'class/daofuncionario.class.php';
require_once 'class/fornecedor.class.php';
require_once 'class/daofornecedor.class.php';
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
                  <h3 class="center">Cadastro de fornecedor</h3>
                  <form class="card-panel col s8 offset-s2 z-depth-5" method="POST">
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="nome" id="nome">
                        <label for="nome">Nome</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="cnpj" id="cnpj">
                        <label for="cnpj">CNPJ</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="telefone" id="telefone">
                        <label for="telefone">Telefone</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="cep" id="cep">
                        <label for="cep">Cep</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="endereco" id="endereco">
                        <label for="endereco">Endereço</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 center">
                        <button class="btn waves-effect grey darken-3" type="submit" name="submit"><i class="material-icons right">send</i>Salvar</button>
                      </div>
                    </div>
                </div>
                </form> 
                <?php
                  if(isset($_POST['submit'])){

                    //if (!isset($_POST['nivel'])) {
                    //  echo "<script> alert('Favor selecione um nível de acesso!')</script>";
                    //}else{
                          $fornecedor = new Fornecedor();
                          $fornecedor->setNome($_POST['nome']);
                          $fornecedor->setCnpj($_POST['cnpj']);
                          $fornecedor->setTelefone($_POST['telefone']);
                          $fornecedor->setCep($_POST['cep']);
                          $fornecedor->setEndereco($_POST['endereco']);
                          $dao = new DaoFornecedor();
                          if ($dao->save($fornecedor)) {
                            echo "<script> alert('Fornecedor cadastrado com sucesso!')</script>";
                            echo "<script> window.location.href='http://localhost/projetonovo/fornecedores.php' </script>";
                          }
                  //}
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
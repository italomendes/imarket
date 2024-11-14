  <?php
    require_once 'class/funcionario.class.php';
    require_once 'class/daofuncionario.class.php';
    if (isset($_GET['codigo'])) {
      $dao = new daoFuncionario();
      $funcionario = $dao->getFuncionario($_GET['codigo']);
      //var_dump($dao->getFuncionario($_GET['codigo']));
      //$daoEndereco = new DaoEndereco();
      //$arrayEndereco = $daoEndereco->getAllEnderecos();

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
                  <h3 class="center">Alterar funcionário</h3>
                  <form class="card-panel col s8 offset-s2 z-depth-5" method="POST">
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="nome" id="nome" value="<?php echo $funcionario->getNome(); ?>">
                        <label for="nome">Nome</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="cpf" id="cpf" value="<?php echo $funcionario->getCpf(); ?>">
                        <label for="cpf">CPF</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="endereco" id="endereco" value="<?php echo $funcionario->getEndereco(); ?>">
                        <label for="endereco">Endereço</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="cep" id="cep" value="<?php echo $funcionario->getCep(); ?>">
                        <label for="cep">Cep</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="email" id="email" value="<?php echo $funcionario->getEmail(); ?>">
                        <label for="email">Email</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="password" name="senha" id="senha">
                        <label for="senha">Senha</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="cargo" id="cargo" value="<?php echo $funcionario->getCargo(); ?>">
                        <label for="cargo">Cargo</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="data_nasc" id="data_nasc" value="<?php echo $funcionario->getData_nasc(); ?>">
                        <label for="data_nasc">Data de Nascimento</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="sexo" id="sexo" value="<?php echo $funcionario->getSexo(); ?>">
                        <label for="sexo">Sexo</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="telefone" id="telefone" value="<?php echo $funcionario->getTelefone(); ?>">
                        <label for="telefone">Telefone</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <select name="administrador" id="administrador">
                          <option value="0">Simples</option>
                          <option value="1">Administrador</option>
                        </select>
                        <label>Nivel de Acesso</label>
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
                          $funcionario = new Funcionario();
                          $funcionario->setNome($_POST['nome']);
                          $funcionario->setCpf($_POST['cpf']);
                          $funcionario->setEndereco($_POST['endereco']);
                          $funcionario->setCep($_POST['cep']);
                          $funcionario->setEmail($_POST['email']);
                          $funcionario->setSenha($_POST['senha']);
                          $funcionario->setCargo($_POST['cargo']);
                          $funcionario->setData_nasc($_POST['data_nasc']);
                          $funcionario->setSexo($_POST['sexo']);
                          $funcionario->setTelefone($_POST['telefone']);
                          $funcionario->setAdministrador($_POST['administrador']);
                          $dao = new DaoFuncionario();
                          $dao->update($funcionario);
                          //if ($dao->update($funcionario)) {
                          //  echo "<script> alert('Funcionario atualizado com sucesso!')</script>";
                          //}

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
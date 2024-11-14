  <?php
    require_once 'class/usuario.class.php';
    require_once 'class/daousuario.class.php';

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
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                  <li><a href="carrinho.php"><i class="large material-icons">shopping_cart</i></a></li>
                  <li><a href="conta.php">Minha conta</a></li>
                  <li class="active"><a href="cadastrousuario.php">Cadastro</a></li>
                  <li><a href="login.php">Login</a></li>
                </ul>
              </div>
            </nav>
            
            <div class="row ">
            <!--NavBar lateral -->
              <ul class="col s2 nav collection" style="border: none;position: relative;top: -6.3px;margin-top: 8px; left: -9px">   
                <li class="collection-item active grey darken-3"><h6 class="center">MENU</h6></li>
                <a href="categoria.php?codigo=1" class="collection-item grey-text text-darken-3">Alimentos</a>
                <a href="categoria.php?codigo=2" class="collection-item grey-text text-darken-3">Bebidas</a>
                <a href="categoria.php?codigo=3" class="collection-item grey-text text-darken-3">Frios</a>
                <a href="categoria.php?codigo=4" class="collection-item grey-text text-darken-3">Horti-fruti</a>
                <a href="categoria.php?codigo=5" class="collection-item grey-text text-darken-3">Higiene</a>
                <a href="categoria.php?codigo=6" class="collection-item grey-text text-darken-3">Limpeza</a>
                <a href="categoria.php?codigo=7" class="collection-item grey-text text-darken-3">Padaria</a>
                <a href="categoria.php?codigo=8" class="collection-item grey-text text-darken-3">Outros</a>
              </ul>
            
              

            <!--Começo do conteúdo -->
            <div class="row collection transparent""> 
              <div class="">
                <div class="col s12 white darken-1">
                  <h3 class="center">Cadastro de cliente</h3>
                  <form class="card-panel col s8 offset-s2 z-depth-5" method="POST">
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="nome" id="nome">
                        <label for="nome">Nome</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="cpf" id="cpf">
                        <label for="cpf">CPF</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="endereco" id="endereco">
                        <label for="endereco">Endereço</label>
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
                        <input type="text" name="email" id="email">
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
                        <input type="text" name="data_nasc" id="data_nasc">
                        <label for="data_nasc">Data de Nascimento</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="sexo" id="sexo">
                        <label for="sexo">Sexo</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="telefone" id="telefone">
                        <label for="telefone">Telefone</label>
                      </div>
                    </div>
                    <!--<div class="row">
                      <div class="input-field col s12">
                        <select name="nivel">
                          <option value="" disabled selected>Selecione</option>
                          <option value="0">Cliente</option>
                        </select>
                        <label>Nivel de Acesso</label>
                      </div>
                    </div>-->
                    <div class="row">
                      <div class="col s12 center">
                        <button class="btn waves-effect grey darken-3" type="submit" name="submit"><i class="material-icons right">send</i>Salvar</button>
                      </div>
                    </div>
                </div>
                
                </form> 
                <?php
                  if(isset($_POST['submit'])){

                   // if (!isset($_POST['nivel'])) {
                     // echo "<script> alert('Favor selecione um nível de acesso!')</script>";
                   // }else{
                          $usuario = new Usuario();
                          $usuario->setNome($_POST['nome']);
                          $usuario->setCpf($_POST['cpf']);
                          $usuario->setEndereco($_POST['endereco']);
                          $usuario->setCep($_POST['cep']);
                          $usuario->setEmail($_POST['email']);
                          $usuario->setSenha($_POST['senha']);
                          $usuario->setData_nasc($_POST['data_nasc']);
                          $usuario->setSexo($_POST['sexo']);
                          $usuario->setTelefone($_POST['telefone']);              
                          //$usuario->setNivel(0);
                          $dao = new DaoUsuario();
                          if ($dao->save($usuario)) {
                            echo "<script> alert('Usuário cadastrado com sucesso!')</script>";
                            echo "<script> window.location.href='http://localhost/projetonovo/login.php' </script>";
                          }
                  //}
                  }

                ?> 
                </div> 
              </div>
              <nav class="collection"><!--Rodapé -->
                <div class="nav row col s12 grey darken-3">
                  <div class="col s10"> © Copyright 2016-2017 italomemendes@gmail.com - All Rights Reserved - Legal</div>
                  <div class="col s2 right"><a href="administracao.php" class="right">Administração</a></div>
                </div>
              </nav>
            </div>
          </div>
        </div><!--Fim do corpo -->
      </div> 

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
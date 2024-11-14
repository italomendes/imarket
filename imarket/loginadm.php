  <?php
    require_once 'class/funcionario.class.php';
    require_once 'class/daofuncionario.class.php';

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
                  <h3 class="center">Login administração</h3>
                  <form class="card-panel col s8 offset-s2 z-depth-5" method="POST">
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="email" name="email" id="email">
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
                      <div class="col s12 center">
                        <button class="btn waves-effect grey darken-3" type="submit" name="submit"><i class="material-icons right">send</i>Entrar</button>
                      </div>
                    </div>
                    </div>
                 </form> 
            <?php
              
              if (isset($_POST['submit'])) {
                $dao = new DaoFuncionario();
                $email = $_POST['email'];
                $funcionario = $dao->login($email);
                session_start();
                //var_dump($usuario);
                if ($funcionario != NULL) {
                  $_SESSION['funcionario'] = $funcionario;
                  if ($funcionario->getSenha() == md5($_POST['senha'])) {
                    var_dump($funcionario);
                  //if ($funcionario->getSenha() == md5($_POST['senha'])) {
                    if ($funcionario->getAdministrador()==1) {
                      echo "<script> window.location.href='http://localhost/projetonovo/administracao.php' </script>";
                    }
                  }else{
                      echo "<script> alert('Senha inválida')</script>";
                    }
                }else{
                  echo "<script> alert('Email não encontrado') </script>";
                }
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
<?php
require_once 'class/funcionario.class.php';
require_once 'class/daofuncionario.class.php';
require_once 'class/produto.class.php';
require_once 'class/daoproduto.class.php';
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
                  <h3 class="center">Cadastro de produto</h3>
                  <form class="card-panel col s8 offset-s2 z-depth-5" method="POST">
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="nome" id="nome">
                        <label for="nome">Nome</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="descricao" id="descricao">
                        <label for="descricao">Descrição</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <select name="categoria" id="categoria">
                          <option value="1">Alimentos</option>
                          <option value="2">Bebidas</option>
                          <option value="3">Frios</option>
                          <option value="4">Horti-fruti</option>
                          <option value="5">Higiene</option>
                          <option value="6">Limpeza</option>
                          <option value="7">Padaria</option>
                          <option value="8">Outros</option>
                        </select>
                        <label>Categoria</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="data_add" id="data_add">
                        <label for="data_add">Data de adição</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="data_val" id="data_val">
                        <label for="data_val">Data de validade</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="valor" id="valor">
                        <label for="valor">Valor</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="qndt_estoque" id="qndt_estoque">
                        <label for="qndt_estoque">Quantidade de estoque</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="cod_barras" id="cod_barras">
                        <label for="cod_barras">Código de barras</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <select name="promo" id="promo">
                          <option value="1">Sim</option>
                          <option value="0">Não</option>
                        </select>
                        <label>Promoção</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 input-field">
                        <input type="text" name="img" id="img">
                        <label for="img">Nome da Imagem</label>
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
                          $produto = new Produto();
                          $produto->setNome($_POST['nome']);
                          $produto->setDescricao($_POST['descricao']);
                          $produto->setCategoria($_POST['categoria']);
                          $produto->setData_add($_POST['data_add']);
                          $produto->setData_val($_POST['data_val']);
                          $produto->setValor($_POST['valor']);
                          $produto->setQndt_estoque($_POST['qndt_estoque']);
                          $produto->setCod_barras($_POST['cod_barras']);
                          $produto->setPromo($_POST['promo']);
                          $produto->setImg($_POST['img']);
                          $dao = new DaoProduto();
                          if ($dao->save($produto)) {
                            echo "<script> alert('produto cadastrado com sucesso!')</script>";
                            echo "<script> window.location.href='http://localhost/projetonovo/produtos.php' </script>";
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
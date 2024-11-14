<?php
require_once 'class/produto.class.php';
require_once 'class/daoproduto.class.php';
/*if (isset($_GET['codigo'])) {
      $dao = new daoProduto();
      $produto = $dao->getCategoria($_GET['codigo']);
      }*/

session_start();
if(!isset($_SESSION['itens'])){
    $_SESSION['itens'] = array();
  }
?>
<!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/new.css"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
      <!-- Modo alternativo de colocar a imagem de fundo
      <style type="text/css">
        body{background-image: url("img/mercado.png");}
      </style>
      -->
      <!--Background -->
      <div class="row ">
        <div id="fundo-externo">
          <div id="fundo">
            <img src="img/mercado.png" alt="" />
          </div>
        </div> -->
        <!--Começo do corpo -->
        <div class="row ">
          <div class=" col s10 offset-s1 card-panel  ">
            <nav> <!--NavBar superior -->
              <div class="collection nav-wrapper grey darken-3">
                <a href="index.php" class="brand-logo"><img class="left" width="50px" height="50px" src="img/logo.png">iMarket</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                  <li><a href="carrinho.php"><i class="large material-icons">shopping_cart</i></a></li>
                  <li><a href="conta.php">Minha conta</a></li>
                  <li><a href="cadastrousuario.php">Cadastro</a></li>
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
                <h3 class="center">
                <?php 
                if ($_GET['codigo'] == 1) {
                  echo "Alimentos";
                }elseif ($_GET['codigo'] == 2) {
                  echo "Bebidas";
                }elseif ($_GET['codigo'] == 3) {
                  echo "Frios";
                }elseif ($_GET['codigo'] == 4) {
                  echo "Horti-fruti";
                }elseif ($_GET['codigo'] == 5) {
                  echo "Higiene";
                }elseif ($_GET['codigo'] == 6) {
                  echo "Limpeza";
                }elseif ($_GET['codigo'] == 7) {
                  echo "Padaria";
                }elseif ($_GET['codigo'] == 8) {
                  echo "Outros";
                } 
                ?>  
                </h3>
                  <div id="promocoes"><!--Texto das promoções -->
                      <?php 
                           $dao = new DaoProduto();

                           $resultado = $dao->getCategoria($_GET['codigo']);
                           //var_dump($resultado);

                           echo "<div class='row col s12 '>";
                            foreach ($resultado as $produto) {
                              //echo $produto->getNome();
                              
                               

                               //for($i=1; $i<3; $i++){ 
                                echo "<a class='black-text' href='produto.php?codigo={$produto->getIdproduto()}'><div class='card col s6 center'><img class='' src='img/produtos/{$produto->getImg()}' aling='center' width='250' height='200'><h5>".$produto->getNome()."</h5><div class='card-action'><span>R$ ".$produto->getValor()." </span></div><form method='POST'><button class='btn-floating halfway-fab waves-effect waves-light grey darken-3 tooltipped' data-position='top' data-delay='0' data-tooltip='Adicionar ao carrinho' id='add{$produto->getIdProduto()}' name = 'produto{$produto->getIdProduto()}'><i class='material-icons'>shopping_cart</i></button></form></div></a>";
                                //} 
                              
                              
                            }
                          echo "</div>";

                      ?>  
                      <?php 
                      foreach ($resultado as $key => $value) {
                      if (isset($_POST['produto'.$value->getIdProduto()])) {
                            array_push($_SESSION['itens'], serialize($value));
                            //var_dump($_SESSION['itens']);
                            echo "<script> window.location.href='http://localhost/projetonovo/carrinho.php'</script>";
                           }
                          }?>
                   <!-- <?php/* 
                           $dao = new DaoProduto();

                           $resultado = $dao->getAll();

                            foreach ($resultado as $key => $produto) {
                              # code...
                              //echo "<tr> ";
                              echo "<div class='row col s12'>";
                              echo "<div class='card-panel col s6 center'>".$produto->getNome()."</div>";
                              echo "<div class='card-panel col s6 center'>".$produto->getNome()."</div>";
                              //echo "<td>".$produto->getNome()."</td>";
                              //echo "<td>".$produto->getValor()."</td>";
                              echo "</div>";
                              /*echo "<td>".$produto->getData_add()."</td>";
                              echo "<td>".$produto->getData_val()."</td>";
                              echo "<td>".$produto->getValor()."</td>";
                              echo "<td>".$produto->getQndt_estoque()."</td>";
                              echo "<td>".$produto->getCod_barras()."</td>";
                              echo "<td></td>";
                              //echo "<td>".$cliente->getEndereco()->getNome()." ".$cliente->getEndereco()->getNumero()."</td>";
                              echo "<td><div class='center'> <a href='http://localhost/projetonovo/alterarproduto.php?codigo={$produto->getIdproduto()}'><i class='material-icons'>update</i></a></div></td>";
                              echo "<td><div class='center'><div class='center'> <a href='http://localhost/projetonovo/deletarproduto.php?codigo={$produto->getIdproduto()}'><i class='material-icons'>delete</i></a></div></td>";
                              echo "<td><div class='center'> <a href='http://localhost/projetonovo/fornecedorproduto.php?codigo={$produto->getIdproduto()}'><i class='material-icons'>add_box</i></a></div></td>";
                              //echo "</tr>";
                            }
                          */
                        ?> -->
                  </div>
                  
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
          </div>
        </div><!--Fim do corpo -->
      </div> 

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
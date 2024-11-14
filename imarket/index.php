<?php
require_once 'class/produto.class.php';
require_once 'class/daoproduto.class.php';
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
                  <nav class="nav-extended">
                    <div class="nav-content collection grey darken-3">
                      <ul class="tabs tabs-transparent">
                        <li class="tab"><a class="active" href="#promocoes">Promoções</a></li><!--Tabs de navegação -->
                        <li class="tab"><a href="#sobrenos">Sobre nós</a></li>
                        <li class="tab"><a href="#parceiros">Parceiros</a></li>
                        <li class="tab"><a href="#funciona">Como funciona</a></li>
                      </ul>
                    </div>
                  </nav>
                  <div id="promocoes"><!--Texto das promoções -->
                

                      <?php 
                           $dao = new DaoProduto();

                           $resultado = $dao->getPromo(1);
                           echo "<div class='row col s12 '>";
                            foreach ($resultado as $key => $produto) {
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
                        }
                      ?>
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
                  <div id="sobrenos" class="card-panel"><!--Texto do sobre nós -->
                  
                  
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elementum elit libero, quis interdum sem consectetur nec. Duis vestibulum elementum leo in tempor. In vehicula augue lacus, vel mattis nulla auctor et. Vestibulum rutrum mi porttitor lorem fermentum, laoreet vestibulum erat vehicula. In hac habitasse platea dictumst. Sed volutpat commodo metus id mattis. Fusce sollicitudin urna vitae ex sagittis, nec pretium nunc fringilla. Praesent eleifend nisl ut nunc tempus, et suscipit urna iaculis. Donec pretium, odio quis suscipit tempor, justo quam viverra dolor, sit amet vestibulum dolor lacus vel mi. Maecenas malesuada faucibus libero ac rhoncus. Donec vehicula tincidunt mauris ut varius. Etiam lacus felis, cursus ut faucibus eget, finibus ac libero. In ullamcorper efficitur magna vel lobortis.

                      In lobortis nibh justo, molestie feugiat diam sodales ac. Proin iaculis lectus nec rhoncus tempor. Pellentesque lacinia, eros ac laoreet pretium, ex ligula condimentum elit, feugiat sollicitudin tortor massa sit amet leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse a interdum metus. Aenean vel fringilla lectus. Phasellus cursus ultricies nibh, sollicitudin dignissim nunc pellentesque accumsan. Mauris metus felis, tincidunt id erat ac, condimentum fermentum purus. Aliquam dapibus dapibus dolor, id cursus nisl tincidunt non. Pellentesque diam diam, rutrum quis metus non, mollis ullamcorper leo. Fusce vel egestas neque, non pulvinar neque.

                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elementum elit libero, quis interdum sem consectetur nec. Duis vestibulum elementum leo in tempor. In vehicula augue lacus, vel mattis nulla auctor et. Vestibulum rutrum mi porttitor lorem fermentum, laoreet vestibulum erat vehicula. In hac habitasse platea dictumst. Sed volutpat commodo metus id mattis. Fusce sollicitudin urna vitae ex sagittis, nec pretium nunc fringilla. Praesent eleifend nisl ut nunc tempus, et suscipit urna iaculis. Donec pretium, odio quis suscipit tempor, justo quam viverra dolor, sit amet vestibulum dolor lacus vel mi. Maecenas malesuada faucibus libero ac rhoncus. Donec vehicula tincidunt mauris ut varius. Etiam lacus felis, cursus ut faucibus eget, finibus ac libero. In ullamcorper efficitur magna vel lobortis.

                      In lobortis nibh justo, molestie feugiat diam sodales ac. Proin iaculis lectus nec rhoncus tempor. Pellentesque lacinia, eros ac laoreet pretium, ex ligula condimentum elit, feugiat sollicitudin tortor massa sit amet leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse a interdum metus. Aenean vel fringilla lectus. Phasellus cursus ultricies nibh, sollicitudin dignissim nunc pellentesque accumsan. Mauris metus felis, tincidunt id erat ac, condimentum fermentum purus. Aliquam dapibus dapibus dolor, id cursus nisl tincidunt non. Pellentesque diam diam, rutrum quis metus non, mollis ullamcorper leo. Fusce vel egestas neque, non pulvinar neque.

                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elementum elit libero, quis interdum sem consectetur nec. Duis vestibulum elementum leo in tempor. In vehicula augue lacus, vel mattis nulla auctor et. Vestibulum rutrum mi porttitor lorem fermentum, laoreet vestibulum erat vehicula. In hac habitasse platea dictumst. Sed volutpat commodo metus id mattis. Fusce sollicitudin urna vitae ex sagittis, nec pretium nunc fringilla. Praesent eleifend nisl ut nunc tempus, et suscipit urna iaculis. Donec pretium, odio quis suscipit tempor, justo quam viverra dolor, sit amet vestibulum dolor lacus vel mi. Maecenas malesuada faucibus libero ac rhoncus. Donec vehicula tincidunt mauris ut varius. Etiam lacus felis, cursus ut faucibus eget, finibus ac libero. In ullamcorper efficitur magna vel lobortis.

                      In lobortis nibh justo, molestie feugiat diam sodales ac. Proin iaculis lectus nec rhoncus tempor. Pellentesque lacinia, eros ac laoreet pretium, ex ligula condimentum elit, feugiat sollicitudin tortor massa sit amet leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse a interdum metus. Aenean vel fringilla lectus. Phasellus cursus ultricies nibh, sollicitudin dignissim nunc pellentesque accumsan. Mauris metus felis, tincidunt id erat ac, condimentum fermentum purus. Aliquam dapibus dapibus dolor, id cursus nisl tincidunt non. Pellentesque diam diam, rutrum quis metus non, mollis ullamcorper leo. Fusce vel egestas neque, non pulvinar neque.
                  </div> 
                  <div id="parceiros" class="card-panel"><!--Texto dos parceiros -->
                    ABIGAIL RODRIGUES
                    ACKIE MCLEAN
                    ADÃO DA COSTA RAVAZI
                    ADÃO DE ASSIS BRASIL
                    ADÃO JOBIM
                    ADELMO OLIVEIRA
                    ADELINO BRASILIENSA
                    ADIL JOBIM BRASIL
                    ADOLFO PFEIFER
                    ADONIAS FILHO
                    ADRIANA DE ANDRADE SOARES
                    ADRIANA PELLEGRIN VIEIRA
                    ADRIANA QUERINO CEZAR DE ANDRADE
                    ADRIANA QUERINO SOUZA DOS SANTOS
                    ADRIANO BRASILIENSE MARCANTÔNIO
                    ADRIANO MENDONÇA SOUZA
                    ADROALDO COELHO LEAL
                    ADYL DE ASSIS BRASIL
                    AFFONSO MANTA
                    D. AFONSO III
                    AFONSO DINIS
                    AGENOR WALDIR WERNZ NETO
                    AGILDO BARATA
                    AGOSTINHO CUSTÓDIO FERREIRA
                    AGOSTINHO DE MONTARROYO
                    AGOSTINHO DE PINHO SILVA
                    AGOSTINHO DE SOUZA CABRAL
                    AGOSTINHO SALINAS MONTARROYO
                    AGOSTINHO VALDEMIRO DA POIAN
                    AGRÍCIO IGUATEMI DIAS DE LIMA
                    ÁGUEDA FRANCISCA
                    AGUEDA FRANCISCA DA CUNHA
                    AÍDA...
                    AINDA DO MONTE (AÍDA)
                    AIRTON TEIXEIRA DA SILVA
                    ALAÍDE RODRIGUES
                    ALARICO BRASILIENSE
                    ALANO DE ASSIS BRASIL
                    ALBA ARRUDA GOMES
                    ALBANO AGUIAR CARVALHO
                    ALBANO BRASILIENSE
                    ALBERTO LUIZ BARAUNA
                    ALBERTO SANTOS=DUMONT
                    ALDA JOBIM
                    ALDA JOBIM BRASIL
                    ALEILTON FONSECA
                    ALEPH CERVO
                    ALEXANDRA BRASIL DOS ANJOS
                    ALEXANDRE CARVALHO DE MORAES
                    ALEXANDRE CAVAGNI
                    ALEXANDRE DA CRUZ GONÇALVES
                    ALEXANDRE DE ASSIS BRASIL
                    ALEXANDRE DE ASSIS BRASIL GRAOSQUE
                    ALEXANDRE DE ASSIS BRASIL SASSI
                    ALEXANDRE DE GUSMÃO
                    ALEXANDRE DIAS RODRIGUES
                    ALEXANDRE VOIGT DA POIAN
                    ALFREDO RODRIGUES DE CARVALHO FILHO
                    ALFREDO TRINDADE
                    ALICE BRUM TUNES
                    ALICE DE ASSIS BRASIL
                    ALICE DE ASSIS BRASIL LEAL
                    ALICE COSTA PEREIRA DE ASSIS BRASIL (ALICINHA)
                    ALICE FIGUEIRA DE ASSIS BRASIL
                    ALICE JOBIM ...
                    ALICE MENNA BARRETO
                    ALICE REIS
                  </div>
                  <div id="funciona" class="card-panel"><!--Texto do como funciona -->

                    Bata as claras em neve e reserve
                    Misture as gemas, a margarina e o açúcar até obter uma massa homogênea
                    Acrescente o leite e a farinha de trigo aos poucos sem parar de bater
                    Por último, adicione as claras em neve e o fermento
                    Despeje a massa em uma forma grande de furo central untada e enfarinhada
                    Asse em forno médio 180 °C, preaquecido por aproximadamente 40 minutos ou ao furar com um garfo, este saia limpo

                    
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
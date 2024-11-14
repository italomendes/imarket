<?php
require_once 'class/usuario.class.php';
require_once 'class/daousuario.class.php';
require_once 'class/venda.class.php';
require_once 'class/daovenda.class.php';
require_once 'class/daoproduto.class.php';
session_start();
if (isset($_SESSION['usuario'])) {
  $usuario = $_SESSION['usuario'];
  //var_dump($usuario);
}else{
  echo "<script> window.location.href='http://localhost/projetonovo/login.php'</script>";
}


//echo "<h1> Bem vindo usuario simples {$usuario->getNome()}</h1>";
?>
<!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
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
                  <li class="active"><a href="conta.php">Minha conta</a></li>
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
                  <h3 class="center">Minha conta</h3>
                  <h5>Dados Pessoais:</h5>
                    <div class="row card-panel grey darken-3">
                      <ul>
                        <li class="white-text">Nome: <?php echo $usuario->getNome() ?></li>
                        <li class="white-text">CPF: <?php echo $usuario->getCpf() ?></li>
                        <li class="white-text">Email: <?php echo $usuario->getEmail() ?></li>
                        <li class="white-text">Endereço: <?php echo $usuario->getEndereco() ?></li>
                      </ul>
                    </div>  
                  <h5>Compras:</h5>
                      <div class="row">
                      <div class="col s12">
                        <ul class="collapsible" data-collapsible="expandable">
                        <?php 
                            $dao = new DaoVenda();
                            $resultado = $dao->getCompra($usuario->getIdusuario());

                            foreach ($resultado as $key => $venda) {
                                      
                        ?>
                          <li>
                            <div class="collapsible-header"><i class="material-icons ">shopping_cart</i>Pedido: <?php echo $venda->getIdvendas() ?>  Data: <?php echo $venda->getData() ?></div>
                            <div class="collapsible-body">
                              <table>
                                <thead>
                                  <tr>
                                    <th>Produtos</th>
                                    <th>Preço Unitário</th>
                                    <th>Quantidade</th>
                                    <th>Preço Total</th>
                                  </tr> 
                                </thead>
                                <tbody>
                                  <tr>
                                  <?php
                                      $dao2 = new DaoProduto();
                                    
                                     $resultado = $dao->getItens($venda->getIdvendas());
                                     foreach ($resultado as $key => $itens) {
                                     $produto = $dao2->getProduto($itens->getIdproduto());     
                                  ?>
                                     <td>
                                       <a href="produto.php?codigo=<?php echo $produto->getIdproduto(); ?>">
                                          <div class="col s2">
                                            <img src="img/produtos/<?php echo $produto->getImg(); ?>" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
                                          </div>
                                          <div class="col s6">
                                            <span class="black-text center-align">
                                              <?php echo $produto->getNome(); ?>
                                            </span>  
                                          </div>
                                        </a>
                                     </td>
                                     <td>
                                       R$ <?php echo $itens->getValor_unitario() ?>
                                     </td>
                                     <td class="center">
                                       <?php echo $itens->getQtd_produto() ?>
                                     </td>
                                     <td>
                                       R$ <?php echo $itens->getValor_total() ?>
                                     </td> 
                                     </tr>
                                     <?php 
                                        } 
                                     ?>         
                                       
                                </tbody>
                              </table> 
                              <h5>Total: R$ <?php echo $venda->getValor() ?></h5>   
                            </div>
                          </li>
                          <?php 
                          } 
                          ?>
                        </ul>
                        </div>
                        </div>
                  <form method="POST">
                    <div class="row">

                      <div class="col s12 center">
                        <button class="btn waves-effect grey darken-3" type="logout" name="logout"><i class="material-icons right">send</i>Sair</button>
                      </div>
                    </div>
                    <?php
                   
                    if (isset($_POST['logout'])) {
                      //session_start();
                      unset($_SESSION['usuario']);
                      if (!isset($_SESSION['usuario'])) {
                        echo "<script> window.location.href='http://localhost/projetonovo/login.php'</script>";
                      }
                    }   
                  ?>
                  </form>
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
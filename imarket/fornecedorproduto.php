  <?php
    require_once 'class/produto.class.php';
    require_once 'class/daoproduto.class.php';
    require_once 'class/funcionario.class.php';
    require_once 'class/daofuncionario.class.php';
    require_once 'class/daofornecedor.class.php';
    require_once 'class/fornecedorproduto.class.php';
    require_once 'class/daofornecedorproduto.class.php';
    if (isset($_GET['codigo'])) {
      $dao = new daoProduto();
      $produto = $dao->getProduto($_GET['codigo']);
      $dao1 = new daoFornecedor();
      $arrayFornecedor = $dao1->getAllFornecedores();
      //$fornecedor = new Fornecedor();
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
          <div class=" col s10 offset-s1 card-panel">
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
                 <h3 class="center">Relacionar produto ao fornecedor</h3>
                  <div class="row">
                    <div class="col s12 ">
                    <form class="card-panel" method="POST">
                      <div class="row">
                        <div class="input-field col s6">
                          <select name="idproduto" id="idproduto"  >
                            <option for="idproduto" value="<?php echo $produto->getIdProduto(); ?>"><?php echo $produto->getNome(); ?></option>
                          </select>  
                          <label for="idproduto">Produto</label>
                        </div>
                        <div class="input-field col s6">
                          <select name="idfornecedor" id="idfornecedor">
                            <?php
                              foreach($arrayFornecedor as $fornecedor){
                                echo "<option value =".$fornecedor->getIdFornecedor()."> ".$fornecedor->getNome();
                                echo "</option>";
                              }
                            ?>
                          </select>  
                          <label for="idfornecedor">Fornecedores</label>
                        </div>
                        <div class="row">
                          <div class="col s12 center">
                            <button class="btn waves-effect grey darken-3" type="submit" name="submit"><i class="material-icons right">send</i>Salvar</button>
                          </div>
                        </div>
                      </div>
                      
                        <?php 
                          if(isset($_POST['submit'])){

                              $fornecedorproduto = new FornecedorProduto();
                              $fornecedorproduto->setIdproduto($_POST['idproduto']);
                              $fornecedorproduto->setIdfornecedor($_POST['idfornecedor']);
                              //var_dump($_POST['idproduto']);
                              //var_dump($_POST['idfornecedor']);
                              $daofp = new DaoFornecedorProduto();

                              //$dao->save($fornecedorproduto);

                              if ($daofp->save($fornecedorproduto) == null) {
                                echo "<script> alert('Relacionado com sucesso!')</script>";
                                echo "<script> window.location.href='http://localhost/projetonovo/produtos.php' </script>";
                              } 
                              //var_dump($daofp->save($fornecedorproduto));
                          }
                        ?>
                      </form>  
                    </div>
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
        </div><!--Fim do corpo -->
      </div> 

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
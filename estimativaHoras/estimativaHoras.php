<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/theme.css" type="text/css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/jquery.bootgrid.css" type="text/css">
  <link rel="stylesheet" href="../fonts/font-awesome.min.css" type="text/css">
  <link rel="icon" href="../img/logo_c.jpg">

</head>

<body style="">
<!--Bibliotecas externas-->
  <script src="../lib/jquery.min.js"></script>
  <script src="../lib/popper.min.js"></script>
  <script src="../lib/bootstrap.min.js"></script>
  <script src="../lib/jquery.bootgrid.js"></script>
  <script src="../lib/jquery.bootgrid.fa.js"></script>

<!--------------------------------------------->  

  <div>
    <div class="w-100 bg-light py-2">
    <nav class="navbar navbar-dark navbar-expand-md mb-0"> 
    <div class="container">
        <a class="" href="../estimativaHoras/estimativaHoras.php"><img class="mb-3" src="../img/logotransparente.png" alt=""></a>
           
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#menu">
                    <span class="navbar-toggler-icon"></span>    
                </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ml-auto">
                     <li class="nav-item ml-auto">
                        <a class="nav-link" href="../estimativaHoras/estimativaHoras.php"><font color="red">Estimativas</font></a>
                    </li> 
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="../cadastro/cadastroHoras.php"><font color="red">Cadastro Objetos</font></a>
                    </li> 
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="../listaChamados/lista.php"><font color="red">Lista de estimativas</font></a>
                    </li> 
                </ul>
            </div>                
          </nav>
       </div>
  </div>
    <!-- Inicio do cabeçalho-->
    <div class="py-3" style="">
      <div class="container">
        <form>
        <div class="row">
          <div class="col-md-4">
            <div class="row">Número chamado</div>
            <div class="row"><input class="w-100 rounded" id="chamado" placeholder="Número de chamado interno"></div>
          </div>
          <div class="col-md-8">
            <div class="row">Descrição</div>
            <div class="row"><input class="w-100 rounded" id="descricao" placeholder="Descrição do chamado"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="row align-items-start"> Projeto </div>
            <div class="row"><input placeholder="Projeto" id="projeto" type="text" class="w-100 rounded">
            </div>
          </div>
          <div class="col-md-4">
            <div class="row">Data de Criação</div>
            <div class="row"><input value="<?php echo date('Y-m-d'); ?>" type="date" id="dataCriacao" class="w-100 rounded"></div>
          </div>
          <div class="col-md-4">
            <div class="row">Responsável técnico</div>
            <div class="row"><input class="w-100 rounded" id="responsavel" placeholder="Consultor responsável pelo chamado"></div>
          </div>
        </div>
        <!--Fim do cabeçalho-->
        <!--Faixa de inicio do cadastro das horas-->
        <div class="row">
          <div class="col-md-12 ">
            <div class="row my-2">
              <div class="col-md-12 my-1 bg-light" style="">
                <h2 class="text-center my-1 text-white" style=""><font color="red">Desenvolvimentos</font></h2>
              </div>
            </div>
          </div>
        </div>
        <!--Inicio do cadastro dos objetos-->

        <div class="row text-center align-items-center my-2 p-0">
          <div class="w-100 col-md-3" style="">
            <div class="dropdown"> Tecnologia <br>
              <div class="dropdown">
                <button required="" class="btn btn-gray" value="0" style="position:relative;" id="btnTecnologia" type="button" data-toggle="dropdown">Escolha uma opção <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <?php include "../php/Objeto.php";
                  $o = new Objeto();
                  $o->GetTecnologias(); ?></ul>
              </div>
            </div>
            <div class="dropdown"> Objeto <br>
              <div class="dropdown">
                <button required="" class="btn btn-gray" value="0" id="btnTipoObjeto" style="position:relative;" type="button" data-toggle="dropdown">Escolha uma opção <span class="caret"></span></button>
                <ul class="dropdown-menu" id="menuObjetos">
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-3 w-100" style="">
            <div class="dropdown mr-5">Origem do objeto<br>
              <button required="" class="btn btn-gray" value="0" id="btnOrigemObjeto" style="position:relative;" type="button" data-toggle="dropdown">Escolha uma opção <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <?php
                $o->GetOrigemObjeto(); ?> </ul>
            </div>
            <div class="dropdown">
              <div class="dropdown mr-5">Nível de complexidade<br> 
                <button required="" class="btn btn-gray" value="0" id="btnNivelComplexidade" style="position:relative;" type="button" data-toggle="dropdown">Escolha uma opção <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <?php
                  $o->GetNivelComplexidade(); ?> </ul>
              </div>
            </div>
          </div>
          <div class="py-0 col-md-6" style="">
            <div class="row"> Descrição <br> <textarea class="w-100 rounded mr-4" id="txtDescricao" rows=""></textarea>
            </div>
            <div class="row"> Critérios de complexidade<br><textarea class="w-100 rounded mr-4" id="txtComplexidade"></textarea>
            </div>
          </div>
        </div>
        <div class="col-md-3 w-100">
          <div class="row">
          </div>
        </div>
        </form>
      </div>
      <div class="row text-center align-items-center my-2">
        <div class="container ">
          <div class="row">
            <button id="btnAdicionar" class="btn btn-gray ml-auto" onclick="validarInserir()">Adicionar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="w-100">
    <div class="container">
      <div class="row">
        <table id="grid-basic" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="false">
          <col width="140">
          <col width="140">
          <col width="140">
          <col width="140">
          <col width="140">
          <col width="40">  
          <col width="40">  
          <col width="40">  
          <col width="40">   
          <col width="40">  
        
        <thead>
            <tr>
              <th  data-column-id="tecnologia">Tecnologia</th>
              <th  data-column-id="tipoObjeto">Tipo do<br>objeto</th>
              <th  data-column-id="descricao">Descrição</th>
              <th  data-column-id="nivelComplexidade">Nível de<br>complexidade</th>
              <th  data-column-id="criterios">Critérios de<br>complexidade</th>
              <th  data-column-id="esforcoTotal">Esforço<br>total</th>
              <th  data-column-id="analiseViabilidade">Análise de<br>viabilidade</th>
              <th  data-column-id="especificacao">Especificação<br>técnica</th>
              <th  data-column-id="codificacao">Codificação</th>
              <th  data-column-id="testes">Testes e<br>QA</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><h5 class="mt-2">Total</h5></td>
              <td><h6 class="mt-2" id="totalSum">        0</h6></td>
              <td><h6 class="mt-2" id="analiseSum">      0</h6></td>
              <td><h6 class="mt-2" id="especificacaoSum">0</h6></td>
              <td><h6 class="mt-2" id="codificacaoSum">  0</h6></td>
              <td><h6 class="mt-2" id="testesSum">       0</h6></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <div class="w-100">
    <div class="container">
      <div class="row">
        <button class="btn btn-gray flex-column ml-auto" onclick="GravarPagina()" id="gravar">Gravar</button>
      </div>
    </div>
  </div>
   <!--Modal Loading -- INICIO -->
   <div id="modalLoading" class="modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="row text-center align-items-center my-3">
          <div class="col-md-12 w-100 m-0">
            <img src = "../img/loading.gif" width=100 heigth=100>
          </div>
        </div>
      </div>
    </div>
  </div><!--Modal Loading -- FIM -->
   <!--Modal OK -- INICIO -->
  <div id="modalOk" class="modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title"></h4>
         <button type="button" class="close" data-dismiss="modal">X</button>
       </div>
        <div class="row text-center align-items-center my-3">
          <div class="col-md-12 w-100 m-0">
            <img src = "../img/ok.png" width=100 heigth=100>
          </div>
        </div>
        <div class="modal-footer w-100">
            <button id="btnPdf" onclick= "GerarPDF(this.value)" type="button" class="btn btn-gray flex-column ml-auto" data-dismiss="modal">Gerar PDF</button>
        </div>
      </div>
    </div>
  </div><!--Modal OK -- FIM -->
        <!--Modal FAIL -- INICIO -->
  <div id="modalFail" class="modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal">X</button>
      </div>
        <div class="row text-center align-items-center my-3">
          <div class="col-md-12 w-100 m-0">
            <img src = "../img/error.png" width=100 heigth=100>
          </div>
        </div>
      </div>
    </div>
  </div><!--Modal FAIL -- FIM -->
 <!--Modal ALERT -- INICIO -->    
    <div id="modalAlert" class="modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>
        <div class="row text-center align-items-center my-3">
          <div class="col-md-12 w-100 m-0">
            <img src = "../img/Alert.png" width=100 heigth=100>
          </div>
        </div>
      </div>
    </div>
  </div><!--Modal ALERT -- FIM -->


        <!--Bibliotecas internas-->
  <script src="js/grid.js"></script>
  <script src="js/form.js"></script>
<!--------------------------------------------->
</body>

</html>

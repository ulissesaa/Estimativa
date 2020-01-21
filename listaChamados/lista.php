<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/theme.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/jquery.bootgrid.css">
  <link rel="stylesheet" href="../fonts/font-awesome.min.css" type="text/css">
  <link rel="icon" href="../img/logo_c.jpg">
</head>

<body>
  <div>
    <div class="w-100 bg-light py-2">
    <nav class="navbar navbar-dark navbar-expand-md mb-0"> 
    <div class="container">
        <a class="" href="../estimativaHoras/estimativaHoras.php"><img class="mb-3" src="../img/logotransparente.png" alt=""></a>
           
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#menu">
                    <span class="navbar-toggler-icon"></span>    
                </button>
            <div class="collapse navbar-collapse ml-auto" id="menu">
                <ul class="navbar-nav ml-auto">
                     <li class="nav-item ml-auto">
                        <a class="nav-link ml-auto" href="../estimativaHoras/estimativaHoras.php"><font color="red">Estimativas</font></a>
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
  <!--Bibliotecas externas - INICIO -->
  <script src="../lib/jquery.min.js"></script>
  <script src="../lib/popper.min.js"></script>
  <script src="../lib/jquery.bootgrid.js"></script>
  <script src="../lib/bootstrap.min.js"></script>
    <!--Bibliotecas externas - FIM-->
  <script src="lista.js"></script>
  <!---------------------------------->
  <div class="pt-5 pb-3">
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <div class="md-3 py-2">Chamado<input type="number" id="chamado" class="w-100 rounded " placeholder="Número do chamado"></div>
        </div>
        <div class="col-md-3">
          <div class="py-2">Responsável<input id="responsavel" class="w-100 rounded " placeholder="Responsável técnico"></div>
        </div>
        <div class="col-md-2">
          <div class="py-2">De<input class="w-100 rounded " placeholder="Data criação" type="date" id="dataInicio"></div>
        </div>
        <div class="col-md-2">
          <div class="py-2">Até<input class="w-100 rounded " placeholder="Data criação" type="date" id="dataFim" ></div>
        </div>
        <div class="col-md-3">
          <div class="d-flex pt-4 py-2">
            <button class="btn btn-gray ml-auto" onclick="PesquisaCabecalho()">Pesquisar</button>
            <button class="btn btn-gray ml-2" onclick="carregarTodosCabecalhos()">Mostrar todos</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="pt-2">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="py-2 d-flex">
            <button class="btn btn-gray ml-auto" onclick="LimparTabela()">Limpar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Tabela de cabeçalhos das estimativas-->
  <div class="">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="py-2">
            <table id="grid-lista" class="table table-condensed table-hover table-striped">
              <thead>
                <tr>
                  <th data-column-id="selected"></th>
                  <th data-column-id="numeroChamado" data-type="numeric">Chamado</th>
                  <th data-column-id="descricao">Descrição</th>
                  <th data-column-id="projeto">Projeto</th>
                  <th data-column-id="dataCriacao">Data de Criação</th>
                  <th data-column-id="responsavel">Responsável</th>
                  <th data-column-id="commands" data-formatter="commands" data-sortable="false">PDF</th>
                </tr>
              </thead>
              <tbody id="tbodyLista"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!------------------------------------------------------------>
  <!--Tabela de horas especificas de um cabeçalho selecionado-->
  <div class="pt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="py-2">
            <table id="grid-objetos" class="table table-condensed table-hover table-striped">
              <thead>
                <tr>
                  <th class="text-left" data-column-id="tecnologia">Tecnologia</th>
                  <th class="text-left" data-column-id="Objeto">Origem</th>
                  <th class="text-left" data-column-id="Objeto">Objeto</th>
                  <th class="text-left" data-column-id="NivelComplexidade">Complexidade</th>
                  <th class="text-center" data-column-id="total">Esforço total</th>
                  <th class="text-center" data-column-id="analiseDeViabilidade">Análise de<br>Viabilidade</th>
                  <th class="text-center" data-column-id="especificacao">Especificação<br>técnica</th>
                  <th class="text-center" data-column-id="codificacao">Codificação</th>
                  <th class="text-center" data-column-id="teste">Testes</th>
                </tr>
              </thead>
              <tbody id="tbodyObjetos"></tbody>
              <tfoot id="tfoot" class="bootgrid-footer container-fluid">
                <tr >
                <td></td>
                <td></td>
                <td></td> 
                <td class="text-center"><h5 class="mt-2">Total</h5></td> 
                <td class="text-center"><h6 style="font-weight: bold" class="mt-2" id="totalSum">        0</h6></td>               
                <td class="text-center"><h6 class="mt-2" id="analiseSum">      0</h6></td>
                <td class="text-center"><h6 class="mt-2" id="especificacaoSum">0</h6></td>
                <td class="text-center"><h6 class="mt-2" id="codificacaoSum">  0</h6></td>
                <td class="text-center"><h6 class="mt-2" id="testesSum">       0</h6></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!------------------------------------------------------------>


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
  </div>
  <!--Modal Loading -- INICIO -->
</body>

</html>
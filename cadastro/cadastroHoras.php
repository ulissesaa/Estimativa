<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/theme.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../fonts/font-awesome.min.css" type="text/css">
  <link rel="icon" href="../img/logo_c.jpg">
</head>

<body class="" id="cadastroHoras">
  <!--Bibliotecas externas - INICIO -->
  <script src="../lib/jquery.min.js"></script>
  <script src="../lib/popper.min.js"></script>
  <script src="../lib/bootstrap.min.js"></script>
  <!--Bibliotecas externas - FIM-->
  <!--Bibliotecas internas - INICIO -->
  <script src="js/function.js"></script>
  <script src="js/calc.js"></script>
  <!--Bibliotecas externas - FIM-->
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
  <div class="my-3">
    <div class="container">
      <div class="row w-100">
        <div class="col-md-3"></div>
        <div class="col-md-4 p-3 pl-3">
          <div class="row w-100 px-2">
            <h5>Modulo </h5>
          </div>
          <div class="row pl-2">
            <button class="btn btn-gray dropdown-toggle" value="0" id="btnTecnologia" data-toggle="dropdown"
              aria-expanded="false"> Escolha uma opção </button>
            <ul id="menuTecnologia" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(33px, 98px, 0px);">
              <?php include "../php/Objeto.php";
                  $o = new Objeto();
                  $o->GetTecnologias();?>
            </ul>
            <button aria-expanded="false" class="btn btn-gray ml-1" data-target="#modalTecnologia"
              data-toggle="modal"> + </button>
          </div>
        </div>
        <div class="col-md-5 p-3 pl-3">
          <div class="row w-100 px-2">
            <h5 class=""> Objeto </h5>
          </div>
          <div class="row pl-2">
            <button class="btn btn-gray dropdown-toggle" value="0" id="btnTipoObjeto" data-toggle="dropdown"
              aria-expanded="false"> Selecione uma tecnologia </button>
            <ul class="dropdown-menu" id="menuObjetos" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(33px, 98px, 0px);">
            </ul>
            <button aria-expanded="false" class="btn btn-gray ml-1" data-target="#modalObjeto" data-toggle="modal"> + </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="py-2">
    <div class="container bg-light">
      <div class="row py-2 px-2">
        <h2 class="px-1 w-100 m-0 text-secondary text-center"><font color="red"> Novo </font></h2>
      </div>
    </div>
  </div>
  <form action="py-2" id="novo">
    <div class="container px-0">
      <div class="row px-2 py-2 border-bottom">
        <div class="col-md-2">
          <p class="m-0 text-center">Nível de<br>complexidade</p>
        </div>
        <div class="col-md-2">
          <p class="m-0 text-center">Análise de<br>viabilidade</p>
        </div>
        <div class="col-md-2">
          <p class="m-0 text-center">Especificação<br>(EF / ET)</p>
        </div>
        <div class="col-md-2">
          <p class="m-0 text-center">Codificação</p>
        </div>
        <div class="col-md-2">
          <p class="m-0 text-center">Testes e QA</p>
        </div>
        <div class="col-md-2">
          <p class="m-0 text-center">Esforço total</p>
        </div>
      </div>
    </div>
    <div class="container px-0">
      <div class="row px-0">
        <div class="col-md-2 py-3">
          <p class="m-0 text-center">Muito baixa</p>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmbanalise" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmbespecificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmbcodificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmbtestes" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmbtotal" placeholder="0" disabled=""> 
        </div>
      </div>
      <div class="row px-0">
        <div class="col-md-2 py-3">
          <p class="m-0 text-center">Baixa</p>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nbanalise" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nbespecificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nbcodificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nbtestes" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nbtotal" placeholder="0" disabled="">
        </div>
      </div>
      <div class="row px-0">
        <div class="col-md-2 py-3">
          <p class="m-0 text-center">Média</p>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmanalise" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmespecificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmcodificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmtestes" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmtotal" placeholder="0" disabled="">
        </div>
      </div>
      <div class="row px-0">
        <div class="col-md-2 py-3">
          <p class="m-0 text-center">Alta</p>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="naanalise" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="naespecificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nacodificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="natestes" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="natotal" placeholder="0" disabled="">
        </div>
      </div>
      <div class="row px-0">
        <div class="col-md-2 py-3">
          <p class="m-0 text-center">Muito alta</p>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmaanalise" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmaespecificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmacodificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmatestes" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="nmatotal" placeholder="0" disabled="">
        </div>
      </div>
    </div>
    <br>
  </form>
  <div class="py-2">
    <div class="container bg-light">
      <div class="row py-2 px-2">
        <h2 class="px-1 w-100 m-0 text-secondary text-center"><font color="red"> Modificação </font></h2>
      </div>
    </div>
  </div>
  <form action="py-2" id="modificacao">
    <div class="container px-0">
      <div class="row px-2 py-2 border-bottom">
        <div class="col-md-2">
          <p class="m-0 text-center">Nível de<br>complexidade</p>
        </div>
        <div class="col-md-2">
          <p class="m-0 text-center">Análise de<br>viabilidade</p>
        </div>
        <div class="col-md-2">
          <p class="m-0 text-center">Especificação<br>técnica</p>
        </div>
        <div class="col-md-2">
          <p class="m-0 text-center">Codificação</p>
        </div>
        <div class="col-md-2">
          <p class="m-0 text-center">Testes e QA</p>
        </div>
        <div class="col-md-2">
          <p class="m-0 text-center">Esforço total</p>
        </div>
      </div>
    </div>
    <div class="container px-0" id="muitoBaixa">
      <div class="row px-0">
        <div class="col-md-2 py-3">
          <p class="m-0 text-center">Muito baixa</p>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmbanalise" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmbespecificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmbcodificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmbtestes" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmbtotal" placeholder="0" disabled="">
        </div>
      </div>
      <div class="row px-0">
        <div class="col-md-2 py-3">
          <p class="m-0 text-center">Baixa</p>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mbanalise" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mbespecificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mbcodificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mbtestes" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mbtotal" placeholder="0" disabled="">
        </div>
      </div>
      <div class="row px-0">
        <div class="col-md-2 py-3">
          <p class="m-0 text-center">Média</p>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmanalise" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmespecificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmcodificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmtestes" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmtotal" placeholder="0" disabled="">
        </div>
      </div>
      <div class="row px-0">
        <div class="col-md-2 py-3">
          <p class="m-0 text-center">Alta</p>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="maanalise" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="maespecificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="macodificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="matestes" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="matotal" placeholder="0" disabled="">
        </div>
      </div>
      <div class="row px-0">
        <div class="col-md-2 py-3">
          <p class="m-0 text-center">Muito alta</p>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmaanalise" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmaespecificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmacodificacao" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmatestes" placeholder="0" required>
        </div>
        <div class="col-md-2 py-2 pl-5 pr-5"><input class="form-control text-center my-1" id="mmatotal" placeholder="0" disabled>
        </div>
      </div>
    </div>
  </form>
<div class="w-100 py-3">
    <div class="container">
      <div class="row">
        <button class="btn btn-gray ml-auto " disabled id="btnAtualizar" onclick="AtualizarHorasObjeto()">Atualizar</button>
        <button class="btn btn-gray ml-3 mr-4" disabled id="btnGravar" onclick="GravarHorasObjeto()">Gravar</button>
      </div>
    </div>
  </div>

  <div class="py-0">
    <div class="container">
      <div class="row">
            <!-- Modal Tecnologia - INICIO -->
        <div class="modal" id="modalTecnologia" role="dialog" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <div class="modal-header">
                  <h4 class="modal-title">Cadastrar Tecnologia</h4>
                  <button type="button" class="close" data-dismiss="modal">X</button>
                </div>
                <div class="row text-center align-items-center my-3">
                  <div class="col-md-12 w-100 m-0">
                    <input required class="form-control ml-auto mr-auto" name="txtDescricaoTecnologia" id="txtDescricaoTecnologia" style="margin-top: 0px; 
                    margin-bottom: 0px; height: 42px;" placeholder="Descrição da tecnologia">
                  </div>
                </div>
                <div class="modal-footer w-100">
                  <button id="gravarTecnologia" type="button" class="btn btn-gray flex-column ml-auto" data-dismiss="modal">Gravar</button>
                </div>
              </div>
            </div>
          </div>
        </div><!-- Modal Tecnologias - FIM -->
        <!-- Modal Objeto - INICIO -->
        <div class="modal" id="modalObjeto" role="dialog" style="display: none;" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <div class="modal-header">
                  <h4 class="modal-title">Cadastrar Objeto</h4>
                  <button type="button" class="close" data-dismiss="modal">X</button>
                </div>
                <div class="row text-center align-items-center my-3">
                  <div class="col-md-12 w-100 m-0">
                    <input required class="form-control ml-auto mr-auto" name="txtDescricaoObjeto" id="txtDescricaoObjeto" style="margin-top: 0px; 									
                    margin-bottom: 0px; height: 42px;" placeholder="Descrição do objeto">
                  </div>
                </div>
                <div class="modal-footer w-100">
                  <button id="gravarObjeto" type="button" class="btn btn-gray flex-column ml-auto" data-dismiss="modal">Gravar</button>
                </div>
              </div>
            </div>
          </div>
        </div><!-- Modal Objeto - FIM -->
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
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Requisição concluida com sucesso</h4>
         <button type="button" class="close" data-dismiss="modal">X</button>
       </div>
        <div class="row text-center align-items-center my-3">
          <div class="col-md-12 w-100 m-0">
            <img src = "../img/ok.png" width=100 heigth=100>
          </div>
        </div>
      </div>
    </div>
  </div><!--Modal OK -- FIM -->
        <!--Modal FAIL -- INICIO -->
  <div id="modalFail" class="modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Processando requisição</h4>
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
      </div>
    </div>
  </div>
</body>

</html>
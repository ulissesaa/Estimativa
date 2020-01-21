<?php
require_once("dompdf/autoload.inc.php");
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;
session_start();
include("../php/Database.php");
try {
  if(!isset($_GET['cod'])){
    echo 'Codigo Cabeçalho não enviado!';
    return;
  }
  $codChamado =  $_GET['cod'];
  $c = new DataBase();
  $conn = $c->GetConnection();

  //$sqlCabecalho = "SELECT numeroChamado, projeto, Chamado.descricao, responsavel, convert(CHAR,dataCriacao,103) 
    //AS dataCriacao FROM Chamado
  $sqlCabecalho = "SELECT numeroChamado, projeto, Chamado.descricao, responsavel, CAST(dataCriacao AS char) AS dataCriacao 
    FROM Chamado 
    WHERE codigo = :cod";
  $stmt = $conn->prepare($sqlCabecalho, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
  $stmt->bindParam(":cod", $codChamado);
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
    $cabecalho = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;

    $sqlDesenvolvimentos = "SELECT 
    Tecnologias.descricao as Tecnologia,
    TipoDesenvolvimento.descricao as Objeto, 
    NivelComplexidade.descricao as Complexidade,
    Desenvolvimentos.descricao as descricao,
    analiseViabilidade,especificacaoTecnica,codificacao,teste,criteriosComplexidade  
    FROM Desenvolvimentos 
    INNER JOIN OrigemObjeto ON Desenvolvimentos.origemObjeto = OrigemObjeto.codigo 
    INNER JOIN TipoDesenvolvimento ON Desenvolvimentos.tipoDesenvolvimento = TipoDesenvolvimento.codigo
    INNER JOIN Tecnologias ON TipoDesenvolvimento.codTecnologia = Tecnologias.codigo
    INNER JOIN NivelComplexidade  ON Desenvolvimentos.nivelComplexidade = NivelComplexidade.codigo
    WHERE codigoChamado = :p1";
    $stmt = $conn->prepare($sqlDesenvolvimentos, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt->bindParam(":p1", $codChamado);
    $stmt->execute();
    
      $linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $body = '
    <style type="text/css">
    @page {
        margin: 50px 50px 50px 35px;
    }
    #footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: right;
        border-top: 2px solid gray;
    }
    #footer .page:after{ 
        content: counter(page); 
    }

</style>
	
	
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../fonts/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="icon" href="../img/logo_c.jpg">
</head>
<body>
  <div class="">
    <div class="">
      <div class="row p-0 mb-3">
        <div class="col-sm-4 col-xs-9"> 
        <img src="../img/tivit_logo_vermelho.png" style="height:60"> 
        </div>
        <div class="col-sm-3 col-xs-3 ml-auto">
          <p class="text-rigth"><span style="font-weight: bold; font-size:12">Ticket: #' . $cabecalho['numeroChamado'] . '</span></p>
        </div>
      </div>
    </div>
  </div>
  <div style="margin-top: 40px;" class="mt-5">
    <div class="">
      <div class="row p-2">
        <div class="col-sm-4 col-xs-4">
          
          <p><span style="font-weight: bold">Projeto: </span>' . $cabecalho['projeto'] .'</p> 
          <p><span style="font-weight: bold">Responsável: </span>' . $cabecalho['responsavel'] . '</p>
          <p><span style="font-weight: bold">Data de Criação: </span>' . $cabecalho['dataCriacao'] . '</p>
        </div>
        <div class="col-sm-3 col-xs-7 ml-auto">
          <p><span style="font-weight: bold"
          > Descri&ccedil;&atilde;o: </span>' . $cabecalho['descricao'] . ' </p>
        </div>
      </div>
    </div>
  </div>
  <div style="margin-top:15px;" class="">
    <div class="">
      <div class="row p-1" style="">
        <div class="col-md-12">
          <table class="table table-bootgrid">
            <thead>
              <tr>
                <th class="border-0 small font-weight-bold">#</th>
                <th class="border-0 small font-weight-bold">Tecnologia</th>
                <th class="border-0 small font-weight-bold">Objeto</th>
                <th class="border-0 small font-weight-bold">Nível Complexidade</th>
                <th class="border-0 small text-center font-weight-bold">Esforço total</th>
                <th class="border-0 small text-center font-weight-bold">Análise Viabilidade</th>
                <th class="border-0 small text-center font-weight-bold">Especificação Técnica</th>
                <th class="border-0 small text-center font-weight-bold">Codificação</th>
                <th class="border-0 small text-center font-weight-bold">Testes</th>
              </tr>
            </thead> 
            <tbody>';
            $tanalise = 0;
            $tespecificacao = 0;
            $tcodificacao = 0; 
            $tteste = 0;
            $ttotal = 0;
            $count = 0;
            foreach ($linhas as $linha) {
              
              $totalLinha = (int)$linha['analiseViabilidade'] + (int)$linha['especificacaoTecnica'] + (int)$linha['codificacao'] + (int)$linha['teste'];
              $body .= '<tr>' .
                '<td>' . ++$count . '</td>' .
                '<td>' . $linha['Tecnologia'] . '</td>' .
                '<td>' . $linha['Objeto'] . '</td>' .
                '<td>' . $linha['Complexidade'] . '</td>' .
                '<td class="text-center" > <span style="font-weight: bold">' . $totalLinha . '</span></td>' .
                '<td class="text-center" >' . $linha['analiseViabilidade'] . '</td>' .
                '<td class="text-center" >' . $linha['especificacaoTecnica'] . '</td>' .
                '<td class="text-center" >' . $linha['codificacao'] . '</td>' .
                '<td class="text-center" >' . $linha['teste'] . '</td>' .
                '</tr>';
                $tanalise += (int)$linha['analiseViabilidade'];
                $tespecificacao += (int)$linha['especificacaoTecnica'];
                $tcodificacao += (int)$linha['codificacao'];
                $tteste += (int)$linha['teste'];
                $ttotal += $totalLinha;

            }
              $total = $tanalise + $tespecificacao + $tcodificacao + $tteste;
            $body .= '<tr>
                <td><span style="font-weight: bold"> Totais </span></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center"> <span style="font-weight: bold">'.$ttotal.' </span></td>
                <td class="text-center"> <span style="font-weight: bold">'.$tanalise.' </span></td>
                <td class="text-center"> <span style="font-weight: bold">'.$tespecificacao.' </span></td>
                <td class="text-center"> <span style="font-weight: bold">'.$tcodificacao.' </span></td>
                <td class="text-center"> <span style="font-weight: bold">'.$tteste.' </span></td>
              </tr>
              </tbody>
          </table>
          <p style="margin-top:30px; font-size:12; font-weight: bold;">Total de horas de desenvolvimento: '.$ttotal.' horas.</p>
        </div>
      </div>
    </div>
  </div>
<div style="margin-top:30px;" class="">
  <div class="">
    <div class="row p-1" style="">
      <div class="col-md-12">
        <table class="table table-bootgrid">
          <thead>
            <tr>
              <th class="border-0 small font-weight-bold">#</th>
              <th class="border-0 small font-weight-bold">Descrição</th>
              <th class="border-0 small font-weight-bold">Critérios de complexidade</th>
            </tr>
          </thead> 
          <tbody>';
              $count=0;
              foreach ($linhas as $linha) {
                $body .= '<tr>'.
                '<td>' . ++$count . '</td>' .
                '<td>' . $linha['descricao'] . '</td>' .
                '<td>' . $linha['criteriosComplexidade'] . '</td>' ;
              }
          $body .= '</tbody>
        </table>
      </div>
    </div>
  </div> 
  </div>
  <div id="footer"><p class="page"></p> </div>
</body>

</html>';
  //echo $body;
  date_default_timezone_set('America/Sao_Paulo');
  $dompdf = new dompdf();
  $dompdf->set_paper('A4');
  $dompdf->load_html($body);
  $dompdf->render();
  $dompdf->stream($cabecalho['numeroChamado'].date('_d.m.Y').'_TIVIT.pdf', array("Attachment" => false));
  

}else{
  echo 'Cabeçalho não encontrado';
}


} catch (Exception $e) {
  die(print_r($e));
}

?>


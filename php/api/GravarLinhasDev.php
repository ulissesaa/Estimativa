<?php
include "../Database.php";

try {
  $linhasGravadas = 0;

  if (isset($_POST["Linhaslista"]) && isset($_POST["Cabecalho"])) {
    $Linhas = $_POST["Linhaslista"];
    $numCabecalho = (int)$_POST["Cabecalho"];
  } else {
    echo json_encode(array('error' => true, 'msg' => 'Não passou no IF'));
  }

  $arrlength = count($Linhas);


  $c = new Database();
  $conn = $c->GetConnection();

  for ($i = 0; $i < $arrlength; $i++) {

    $query = "INSERT INTO Desenvolvimentos 
    (codigoChamado, origemObjeto, tipoDesenvolvimento, nivelComplexidade, 
    descricao, criteriosComplexidade, analiseViabilidade, especificacaoTecnica, codificacao, teste) 
    VALUES (:codigoChamado, :origemObjeto, :tipoDesenvolvimento, :nivelComplexidade, 
    :descricao, :criteriosComplexidade, :analiseViabilidade, :especificacaoTecnica, :codificacao, :testes) ";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":codigoChamado", $numCabecalho);
    $stmt->bindParam(":origemObjeto",$Linhas[$i]["OrigemObjeto"]);
    $stmt->bindParam(":tipoDesenvolvimento",$Linhas[$i]["TipoDesenvolvimento"]);
    $stmt->bindParam(":nivelComplexidade", $Linhas[$i]["NivelComplexidade"]);
    $stmt->bindParam(":analiseViabilidade",$Linhas[$i]["analiseViabilidade"]);
    $stmt->bindParam(":especificacaoTecnica",$Linhas[$i]["especificacaoTecnica"]);
    $stmt->bindParam(":codificacao", $Linhas[$i]["Codificacao"]);
    $stmt->bindParam(":testes",$Linhas[$i]["Testes"]);
    $stmt->bindParam(":descricao", $Linhas[$i]["Descricao"]);
    $stmt->bindParam(":criteriosComplexidade", $Linhas[$i]["CriteriosComplexidade"]);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $linhasGravadas += 1;
      $stmt = null;
    } else {
      exit;
    }
  }

  if ($linhasGravadas == $arrlength+1) {
    $result = array('msg' => 'Horas gravadas com sucesso!', 'error' => false);
  } else {
    $result = array('msg' => 'Erro na gravação das linhas! Linhas gravadas '. (int)$linhasGravadas . ', linhas não gravadas '. (int)$arrlength - (int)$linhasGravadas ,'error' => true);
  }
  echo json_encode($result);

} catch (Exception $e) {
  die($e);
}




?>

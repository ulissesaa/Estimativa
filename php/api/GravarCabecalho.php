<?php

include '../Database.php';


try {
    if (isset($_POST["Linhas"]) && isset($_POST["chamado"])) {
        $Linhas = $_POST["Linhas"];
        $Cabecalho = $_POST["chamado"];
      } else {
        echo json_encode(array('error' => true, 'msg' => 'Post invalido'));
        var_dump($_POST);
        return;
      }
    $arrlength = count($Linhas);



    $c = new Database();
    $conn = $c->GetConnection();
    $conn->beginTransaction();

    $query = "INSERT INTO Chamado (numeroChamado, projeto, descricao, dataCriacao, responsavel) VALUES (?,?,?,?,?);";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $Cabecalho['chamado']);
    $stmt->bindParam(2, $Cabecalho['projeto']);
    $stmt->bindParam(3, $Cabecalho['descricao']);
    $stmt->bindParam(4, $Cabecalho['dataCriacao']);
    $stmt->bindParam(5, $Cabecalho['responsavel']);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        $id = $conn->lastInsertId();
        $stmt = null;
        $linhasGravadas = 0;
        
        for ($i = 0; $i < $arrlength; $i++) {

            $query = "INSERT INTO Desenvolvimentos 
            (codigoChamado, origemObjeto, tipoDesenvolvimento, nivelComplexidade, 
            descricao, criteriosComplexidade, analiseViabilidade, especificacaoTecnica, codificacao, teste) 
            VALUES (:codigoChamado, :origemObjeto, :tipoDesenvolvimento, :nivelComplexidade, 
            :descricao, :criteriosComplexidade, :analiseViabilidade, :especificacaoTecnica, :codificacao, :teste);";
            $stmt = $conn->prepare($query);
        
            $stmt->bindParam(":codigoChamado", $id);
            $stmt->bindParam(":origemObjeto",$Linhas[$i]["OrigemObjeto"]);
            $stmt->bindParam(":tipoDesenvolvimento",$Linhas[$i]["TipoDesenvolvimento"]);
            $stmt->bindParam(":nivelComplexidade", $Linhas[$i]["NivelComplexidade"]);
            $stmt->bindParam(":analiseViabilidade",$Linhas[$i]["AnaliseViabilidade"]);
            $stmt->bindParam(":especificacaoTecnica",$Linhas[$i]["EspecificacaoTecnica"]);
            $stmt->bindParam(":codificacao", $Linhas[$i]["Codificacao"]);
            $stmt->bindParam(":teste",$Linhas[$i]["Testes"]);
            $stmt->bindParam(":descricao", $Linhas[$i]["Descricao"]);
            $stmt->bindParam(":criteriosComplexidade", $Linhas[$i]["CriteriosComplexidade"]);
        
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
              $linhasGravadas += 1;
              $stmt = null;
            } else {
              $i = $arrlength+1;
            }
          }
        
          if ($linhasGravadas == $arrlength) {
            $conn->commit();
            $result = array('msg' =>  $arrlength.' linha(s) gravada(s) com sucesso!', 'error' => false, 'cod' => $id);
          } else {
            $conn->rollBack();
            $result = array('erro' => $stmt, 'msg' => 'Erro na gravação das linhas!' ,'error' => true);
          }

    }else{
        $conn->rollBack();
        $result = array('msg'=>'Erro na gravação do cabeçalho!', 'error'=>true);
        var_dump($stmt);
    }
    echo json_encode($result);

} catch (Exception $e) {
    die($e);
}


?>
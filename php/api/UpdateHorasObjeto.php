<?php
include '../Database.php';

try{
    $c = new Database();
    if(isset($_POST['lista'])){
        $cont=0;
        $lista = $_POST['lista'];
        $conn = $c->GetConnection();
        $conn->beginTransaction();
               

        $query = "UPDATE HorasObjeto SET 
        analiseViabilidade = :p1, especificacaoTecnica = :p2, codificacao = :p3, teste = :p4
        WHERE origemObjeto = :c1 AND tipoDesenvolvimento = :c2 AND nivelComplexidade = :c3";

        for($i=0;$i<10;$i++){

            $stmt = $conn->prepare($query);
            $stmt->bindParam(":c1",$lista[$i]["origemObjeto"]);
            $stmt->bindParam(":c2",$lista[$i]["tipoDesenvolvimento"]);
            $stmt->bindParam(":c3",$lista[$i]["nivelComplexidade"]);
            $stmt->bindParam(":p1",$lista[$i]["analiseViabilidade"]);
            $stmt->bindParam(":p2",$lista[$i]["especificacao"]);
            $stmt->bindParam(":p3",$lista[$i]["codificacao"]);
            $stmt->bindParam(":p4",$lista[$i]["teste"]);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                $cont += 1;
                $stmt=null;
            }else{
                $i=10;
            }
        }

        if($cont == 10){
            $conn->commit();
            echo json_encode(array('error' => false, 'msg' => 'Horas atualizadas com sucesso!'));
            return;
        }else{
            $conn->rollBack();
            echo json_encode(array('error' => true, 'msg' => 'Erro na atualização!'));
            return;
        }

    }else{
        echo json_encode(array('error' => true, 'msg' => 'Não foi possivel receber o POST'));
        return;
    }
    


}
catch(Exception $ex){

    die($ex);
}


?>
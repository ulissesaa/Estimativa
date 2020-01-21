<?php
include '../Database.php';

try{
    
    if(isset($_POST['horas'])){
        $horas = $_POST['horas'];
        $codAdd = 0;
        $c = new Database();
        $conn = $c->GetConnection();
        $conn->beginTransaction();

        $query = "INSERT INTO 
                    HorasObjeto (origemObjeto, tipoDesenvolvimento, nivelComplexidade, analiseViabilidade, especificacaoTecnica, codificacao, teste) 
                    VALUES(:origemObjeto, :tipoDesenvolvimento, :nivelComplexidade, :analiseViabilidade, :especificacaoTecnica, :codificacao, :teste)";
        for ($i=0; $i < 10; $i++) {  
            
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":origemObjeto",$horas[$i]["origemObjeto"]);
            $stmt->bindParam(":tipoDesenvolvimento",$horas[$i]["tipoDesenvolvimento"]);
            $stmt->bindParam(":nivelComplexidade",$horas[$i]["nivelComplexidade"]);
            $stmt->bindParam(":analiseViabilidade",$horas[$i]["analiseViabilidade"]);
            $stmt->bindParam(":especificacaoTecnica",$horas[$i]["especificacao"]);
            $stmt->bindParam(":codificacao",$horas[$i]["codificacao"]);
            $stmt->bindParam(":teste",$horas[$i]["teste"]);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                $codAdd += 1;
                $stmt = null;
            }
            else{
                $i=10;
            }
        }
    }

    if($codAdd == 10){
        $conn->commit();
        echo json_encode(array('error'=> false, 'msg'=> 'Todas as horas gravadas com sucesso!'));
        return;
    }else{
        $conn->rollBack();
        echo json_encode(array('error'=> true, 'msg'=> 'Erro ao gravar horas!'));
        return;
    }

}catch(Exception $ex){
    echo json_encode(array('prob'=>$ex));
    return;
}


?>
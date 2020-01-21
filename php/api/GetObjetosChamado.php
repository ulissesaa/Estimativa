<?php
include '../Database.php';

try{
    if(isset($_POST['cod'])){
        $codigoChamado = (int)$_POST['cod'];

        $c = new Database();
        $conn = $c->GetConnection();

        $query = "SELECT 
        Tecnologias.descricao as Tecnologia,
        OrigemObjeto.descricao as Origem, 
        TipoDesenvolvimento.descricao as Objeto, 
        NivelComplexidade.descricao as Complexidade,
        analiseViabilidade,
        especificacaoTecnica,
        codificacao,
        teste 
        
        FROM Desenvolvimentos 
        INNER JOIN OrigemObjeto ON Desenvolvimentos.origemObjeto = OrigemObjeto.codigo 
        INNER JOIN TipoDesenvolvimento ON Desenvolvimentos.tipoDesenvolvimento = TipoDesenvolvimento.codigo
        INNER JOIN Tecnologias ON TipoDesenvolvimento.codTecnologia = Tecnologias.codigo
        INNER JOIN NivelComplexidade  ON Desenvolvimentos.nivelComplexidade = NivelComplexidade.codigo
        
        WHERE Desenvolvimentos.codigoChamado = :p1";

        $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(':p1', $codigoChamado);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            return;
        }else{
            echo json_encode(array('error' => true, 'msg' => 'Nenhuma linha encontrada para este chamado'));
        }

    }else{
        echo json_encode(array('error' => true));
        var_dump($_POST);
    }


}catch(Exception $ex){
    print_r(die($ex));
}

?>
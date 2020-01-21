<?php
include '../Database.php';
ini_set('MAX_EXECUTION_TIME', '3600');

try {
    if (isset($_POST['type']) ?? null ) {
        
        $type = $_POST['type'];
        $c = new Database();
        $conn = $c->GetConnection();

        //////////////////////////////////////////////// Pesquisa por todas as linhas 
        if ($type == 'todos-chamados') {

            $stmt = $conn->prepare("SELECT * FROM Chamado", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                return;
            } else {
                echo json_encode(array('error' => true, 'msg' => 'query não retornou nenhuma linha na pesquisa por todas as linhas'));
                return;
            }
        } 
        /////////////////////////////////////////////////// Pesquisa por chamado
        else if ($type == 'por-chamado') {
            if (isset($_POST['chamado'])) {
                $chamado = (int)$_POST['chamado'];
                $stmt = $conn->prepare("SELECT * FROM Chamado WHERE numeroChamado = :p1", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stmt->bindParam(':p1', $chamado);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                    return;
                } else {
                    echo json_encode(array('error' => true, 'msg' => 'query não retornou nenhuma linha na pesquisa por chamado'));
                    return;
                }
            }
        }
        ///////////////////////////////// Pesquisa por projeto
        else if ($type == 'por-responsavel') {

            if (isset($_POST['responsavel'])) {
                $responsavel = '%'.$_POST['responsavel']. '%';

                $stmt = $conn->prepare("SELECT * FROM Chamado WHERE responsavel LIKE :p1", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stmt->bindParam(':p1',$responsavel);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                    return;
                } else {
                    echo json_encode(array('error' => true, 'msg' => 'query não retornou nenhuma linha na pesquisa por responsaveis'));
                    return;
                }
            }

        }
        //////////////////////////////// Pesquisa por um range de data
        else if($type == 'dataRange'){
            if(isset($_POST['dataInicio']) && $_POST['dataFim']){

                $dataInicio = $_POST['dataInicio'];
                $dataFim = $_POST['dataFim'];

                $stmt = $conn->prepare("SELECT * FROM Chamado WHERE dataCriacao >= :p1 AND dataCriacao <= :p2", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stmt->bindParam(':p1',$dataInicio);
                $stmt->bindParam(':p2',$dataFim);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                    return;
                } else {
                    echo json_encode(array('error' => true, 'msg' => 'query não retornou nenhuma linha na pesquisa por Range de data'));
                    return;
                }
            }

        }
        /////////////////////////////////////// Pesquisa combinada de chamado e Projeto
        else if($type == 'chamado-responsavel'){
            if(isset($_POST['chamado']) && isset($_POST['responsavel'])){

                $chamado = (int)$_POST['chamado'];
                $responsavel = '%'.$_POST['responsavel']. '%';

                $stmt = $conn->prepare("SELECT * FROM Chamado WHERE numeroChamado = :p1 AND responsavel LIKE :p2", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stmt->bindParam(':p1',$chamado);
                $stmt->bindParam(':p2',$responsavel);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                    return;
                } else {
                    echo json_encode(array('error' => true, 'msg' => 'query não retornou nenhuma linha na pesquisa por chamado e responsavel'));
                    return;
                }
            }
        }
        ////////////////////////////////////////// Pesquisa combinada de chamado e data de criação
        else if($type == 'chamado-data'){
            if(isset($_POST['chamado']) && isset($_POST['dataInicio']) && isset($_POST['dataFim'])){

                $chamado = (int)$_POST['chamado'];
                $dataInicio = $_POST['dataInicio'];
                $dataFim = $_POST['dataFim'];
                
                $stmt = $conn->prepare("SELECT * FROM Chamado WHERE numeroChamado = :p1 AND dataCriacao >= :p2 AND dataCriacao <= :p3", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stmt->bindParam(':p1',$chamado);
                $stmt->bindParam(':p2',$dataInicio);
                $stmt->bindParam(':p3',$dataFim);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                    return;
                } else {
                    echo json_encode(array('error' => true, 'msg' => 'query não retornou nenhuma linha na pesquisa por chamado e range de datas'));
                    return;
                }

            }
        }

        else if($type == 'responsavel-data'){
            if(isset($_POST['responsavel']) && isset($_POST['dataInicio']) && isset($_POST['dataFim'])){

                $responsavel = '%'.$_POST['responsavel']. '%';
                $dataInicio = $_POST['dataInicio'];
                $dataFim = $_POST['dataFim'];
                
                $stmt = $conn->prepare("SELECT * FROM Chamado WHERE responsavel LIKE :p1 AND dataCriacao >= :p2 AND dataCriacao <= :p3", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stmt->bindParam(':p1',$responsavel);
                $stmt->bindParam(':p2',$dataInicio);
                $stmt->bindParam(':p3',$dataFim);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                    return;
                } else {
                    echo json_encode(array('error' => true, 'msg' => 'query não retornou nenhuma linha na pesquisa por responsavel e range de datas'));
                    return;
                }

            }
        }

        else if($type == 'todos-parametros'){
            if(isset($_POST['responsavel']) && isset($_POST['chamado']) && isset($_POST['dataInicio']) && isset($_POST['dataFim'])){

                $chamado = (int)$_POST['chamado'];
                $responsavel = '%'.$_POST['responsavel']. '%';
                $dataInicio = $_POST['dataInicio'];
                $dataFim = $_POST['dataFim'];
                
                $stmt = $conn->prepare("SELECT * FROM Chamado WHERE responsavel LIKE :p1 AND dataCriacao >= :p2 AND dataCriacao <= :p3 AND responsavel LIKE :p4", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stmt->bindParam(':p1',$responsavel);
                $stmt->bindParam(':p2',$dataInicio);
                $stmt->bindParam(':p3',$dataFim);
                $stmt->bindParam(':p4',$responsavel);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                    return;
                } else {
                    echo json_encode(array('error' => true, 'msg' => 'query não retornou nenhuma linha na pesquisa por todos os parametros'));
                    return;
                }

            }
        }

    } else {
        echo json_encode(array('error' => true, 'msg' => 'Pesquisa sem type definido'));
        return;
    }
} catch (Exception $ex) {
    die(print_r($ex));
}


?>
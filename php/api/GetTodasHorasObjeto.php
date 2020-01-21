<?php
include '../Database.php';

try{

if(isset($_POST['cod'])){
    $cod = $_POST['cod'];
    $c = new Database();
    $conn = $c->GetConnection();

    $query = "SELECT * FROM HorasObjeto WHERE TipoDesenvolvimento = :cod";
    $stmt = $conn->prepare($query,array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt->bindParam(':cod', $cod);
    $stmt->execute();

    if($stmt->rowCount() == 10){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $res[] = $row; 
    }
    echo json_encode($res);
    }
    else if ($stmt->rowCount() > 0 && $stmt->rowCount() < 10){
        echo json_encode(array( 'error' => true, 'msg' => 'Objeto possui menos de 10 linhas gravadas!'));
    }else{
        echo json_encode(array('cod' => 1, 'msg' => 'Objeto não possui horas cadastradas!'));
    }
    
}else{
    var_dump($_POST);
    echo json_encode(array('errorPost'=> true, 'msg'=> $_POST));
}




}
catch(Exception $ex){
    return $ex;
}


?>
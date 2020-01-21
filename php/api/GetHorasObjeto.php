<?php
include '../Database.php';

$origemObjeto = $_GET['origemObjeto'];
$tipoDesenvolvimento = $_GET['tipoDesenvolvimento'];
$nivelComplexidade = $_GET['nivelComplexidade'];


$c = new DataBase();
$conn = $c->GetConnection();




$query = "SELECT * FROM HorasObjeto WHERE
          origemObjeto = $origemObjeto AND 
          tipoDesenvolvimento = $tipoDesenvolvimento AND 
          nivelComplexidade = $nivelComplexidade";
$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$stmt->execute();

if ($stmt->rowCount() > 0) {  
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}
else{
    echo json_encode(array('error'=> true, 'msg' => 'Objeto não possui horas cadastradas!'));
}




?>
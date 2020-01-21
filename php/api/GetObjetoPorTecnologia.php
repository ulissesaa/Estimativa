<?php
include '../Database.php';

$codTecnologia = $_GET['codTecnologia'];
$c = new DataBase();
$conn = $c->GetConnection();

$query = "SELECT codigo, descricao FROM TipoDesenvolvimento WHERE codTecnologia = $codTecnologia ORDER BY descricao ASC";
$stmt = $conn->query($query);

$objetos = null;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $objetos[] = array(
        'codigo' => $row['codigo'],
        'descricao' => $row['descricao']
    );
}


if ($objetos != null) {
    echo json_encode($objetos);
}else{
    echo json_encode(array('error' => true, 'msg' => 'Vazio'));
}


?>
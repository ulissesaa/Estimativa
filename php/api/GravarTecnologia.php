<?php
include '../Database.php';
try {
	$descricao = $_POST['descricao'];
	$c = new DataBase();
	$conn = $c -> GetConnection();

	$stmt = $conn -> prepare("INSERT INTO Tecnologias(descricao) VALUES (:descricao)");
	$stmt -> bindParam(':descricao', $descricao);
	$stmt -> execute();
	if ($stmt -> rowCount() > 0) {
		$codigo = $conn -> lastInsertId();
		$result = array('error' => false, 'codigo' => $codigo, 'msg' => 'Tecnologia adicionada!');
	} else {
		$result = array('error' => true, 'msg' => 'Tecnologia não adicionada!');
	}
	echo json_encode($result);
} catch (Exception $e) {
	die($e);

}
?>
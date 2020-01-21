<?php
include '../Database.php';
try {
	$descricao = $_POST['descricao'];
	$codTecnologia = $_POST['codTecnologia'];
	$c = new DataBase();
	$conn = $c -> GetConnection();

		$stmt = $conn -> prepare("INSERT INTO TipoDesenvolvimento (descricao, codTecnologia) VALUES  (:descricao, :codTecnologia)");
		$stmt -> bindParam('descricao', $descricao);
		$stmt -> bindParam('codTecnologia', $codTecnologia, PDO::PARAM_INT);
		$stmt -> execute();

		if ($stmt -> rowCount() > 0) {
			$codigo = $conn -> lastInsertId();
			$result = array('error' => false, 'codigo' => $codigo, 'msg' => 'Objeto adicionado!');
	} else {
		$result = array('error' => true, 'msg' => 'Objeto não adicionado!');
	}
	echo json_encode($result);
} catch (Exception $e) {
	die($e);
}
?>


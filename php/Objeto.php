<?php
include 'Database.php';

class Objeto {

    function GetObjetos()
    {
        
        $c = new DataBase();
        $conn = $c->GetConnection();

        $query = "SELECT codigo, descricao FROM TipoDesenvolvimento ORDER BY descricao";
        $stmt = $conn->query($query);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo ('<li role="presentation" style="position:relative;width:100%;">');
            echo ('<a onclick="selectObjeto(' . $row['codigo'] . ',' . 'this.innerText' . ')" class=dropdown-item >' . $row['descricao'] . '</a>');
            echo ('</li>');

        }
    }


    function GetNivelComplexidade()
    {
        $c = new DataBase();
        $conn = $c->GetConnection();


        $query = "SELECT codigo, descricao FROM NivelComplexidade";
        $stmt = $conn->query($query);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo ('<li role="presentation" style="position:relative;width:100%;">');
            echo ('<a onclick="selectNivel(' . $row['codigo'] . ',' . 'this.innerText' . ')" class=dropdown-item >' . $row['descricao'] . '</a>');
            echo ('</li>');
        }

    }

    function GetTecnologias()
    {
        $c = new DataBase();
        $conn = $c->GetConnection();


        $query = "SELECT codigo, descricao FROM Tecnologias ORDER BY descricao";
        $stmt = $conn->query($query);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo ('<li role="presentation" style="position:relative;width:100%;">');
            echo ('<a onclick="selectTecnologia(' . $row['codigo'] . ',' . 'this.innerText' . ')" class=dropdown-item >' . $row['descricao'] . '</a>');
            echo ('</li>');

        }

    }

    function GetOrigemObjeto()
    {
        $c = new DataBase();
        $conn = $c->GetConnection();


        $query = "SELECT codigo, descricao FROM OrigemObjeto";
        $stmt = $conn->query($query);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo ('<li role="presentation" style="position:relative;width:100%;">');
            echo ('<a onclick="selectOrigemObjeto(' . $row['codigo'] . ',' . 'this.innerText' . ')" class=dropdown-item >' . $row['descricao'] . '</a>');
            echo ('</li>');

        }

    }

}
?>
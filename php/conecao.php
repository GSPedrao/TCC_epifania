<?php


$host = "localhost";
$usuario = "root";
$senha = "";
$dataBase = "tecnolist";

$conn = mysqli_connect($host, $usuario, $senha, $dataBase);

if($conn->connect_errno){
    echo "Falha na conexão: (" . $conn->connect_errno . ")" . $conn->connect_error;
}


?>
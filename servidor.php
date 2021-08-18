<?php
$servidor = "localhost:3306";
$usuario = "root";
$senha = "";
$bancodedados = "wordpress";

$conn = new mysqli($servidor, $usuario, $senha, $bancodedados);

if($conn->connect_error){
    die("Falha na conexão: ". $conn->connect_error);
}
?>
<?php
// Exemplo de script para buscar pedidos do banco de dados

// Conectar ao banco de dados (atualize as credenciais conforme necessário)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consultar os pedidos
$sql = "SELECT id, cliente, data, status FROM pedidos";
$result = $conn->query($sql);

$pedidos = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
    }
} 

$conn->close();

// Retornar os pedidos em formato JSON
header('Content-Type: application/json');
echo json_encode($pedidos);
?>

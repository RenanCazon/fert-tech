<?php
// login.php

// Conectar ao banco de dados (use suas próprias credenciais)
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

// Crie a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifique se o e-mail e a senha foram enviados
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Proteja contra SQL injection
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Consulta para verificar o usuário
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login bem-sucedido
        echo 'Login bem-sucedido';
    } else {
        // Credenciais inválidas
        echo 'E-mail ou senha incorretos';
    }
} else {
    echo 'Por favor, preencha todos os campos';
}

// Feche a conexão
$conn->close();
?>


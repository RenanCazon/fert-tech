<?php
try {
    // Conectar ao banco de dados (use suas próprias credenciais)
    $db = new PDO('mysql:host=localhost;dbname=f2lfer00_login', 'f2lfer00_admin', '14093@Re');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Receber os dados do formulário de cadastro
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Validar os dados do formulário de cadastro
    if (empty($nome)) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'O nome é obrigatório.']);
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'O e-mail é inválido.']);
        return;
    }

    if (strlen($senha) < 8) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'A senha deve ter pelo menos 8 caracteres.']);
        return;
    }

    // Criptografar a senha
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Inserir os dados do formulário de cadastro no banco de dados
    $sql = 'INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)';
    $stmt = $db->prepare($sql);
    $stmt->execute([$nome, $email, $senha_hash]);

    // Enviar uma mensagem de sucesso ou de erro
    if ($stmt->rowCount() > 0) {
        echo json_encode(['status' => 'sucesso', 'mensagem' => 'Cadastro realizado com sucesso!']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Ocorreu um erro ao cadastrar o usuário.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao conectar ao banco de dados: ' . $e->getMessage()]);
}
?>

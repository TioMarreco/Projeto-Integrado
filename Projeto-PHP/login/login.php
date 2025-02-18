<?php

$host = 'localhost'; 
$dbname = 'Pedro V.'; 
$user = 'root'; 
$pass = '1204';

// Conectando ao banco de dados
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}

// Pegando dados do formulário
$nome = $_POST['nome'];
$senha = $_POST['senha'];

// Consulta no banco de dados
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE nome = :nome AND senha = :senha");
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':senha', $senha);
$stmt->execute();

// Verifica se o usuário foi encontrado
if ($stmt->rowCount() > 0) {
    if ($nome == 'ADM' && $senha == '120406') {
        // Redireciona para escolha-ADM.html
        header("Location: escolha/escolha-ADM.html");
        exit();
    } else {
        // Redireciona para escolha.html
        header("Location: escolha/escolha.html");
        exit();
    }
} else {
    echo "Nome ou senha incorretos!";
}

?>
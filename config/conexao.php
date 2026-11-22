<?php
// Conexão local com o MySQL do XAMPP.
// Ajuste usuário e senha se sua instalação utilizar outras credenciais.

$host = 'localhost';
$banco = 'catalogo_beleza';
$usuario = 'root';
$senha = '';

$dsn = "mysql:host={$host};dbname={$banco};charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $usuario, $senha, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    // Não exiba detalhes técnicos da conexão para o visitante.
    error_log('Erro de conexão com o banco de dados: ' . $e->getMessage());
    http_response_code(500);
    exit('Não foi possível conectar ao banco de dados. Confira as instruções em docs/execucao-incremento.md.');
}

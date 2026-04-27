<?php
// config.php
$host = 'localhost';
$db = 'gerenciamento_produtos';   // ← banco
$user = 'root';                      // usuário
$pass = '';                          // senha

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>
<?php
// processa_produto.php - Responsável por cadastrar e excluir produtos

require 'config.php';   // Carrega a conexão com o banco

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    // ==================== CADASTRO DE PRODUTO ====================
    if ($acao === 'cadastrar') {
        
        $descricao    = trim($_POST['descricao']);
        $categoria    = $_POST['categoria'];
        $valor_compra = floatval($_POST['valor_compra']);
        $valor_venda  = floatval($_POST['valor_venda']);
        $estoque      = intval($_POST['estoque']);

        // Prepara e executa a inserção no banco
        $stmt = $pdo->prepare("INSERT INTO produtos 
            (descricao, categoria, valor_compra, valor_venda, estoque) 
            VALUES (?, ?, ?, ?, ?)");
        
        $stmt->execute([$descricao, $categoria, $valor_compra, $valor_venda, $estoque]);

        echo "<script>
            alert('✅ Produto cadastrado com sucesso!');
            window.location.href = 'index.php';
        </script>";
    } 
    
    // ==================== EXCLUIR PRODUTO ====================
    elseif ($acao === 'excluir') {
        $id = intval($_POST['id']);

        $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->execute([$id]);

        echo "ok";   // Resposta para o JavaScript
    }
}
?>
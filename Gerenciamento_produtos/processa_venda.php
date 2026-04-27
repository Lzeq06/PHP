<?php
// processa_venda.php - Responsável por fazer a venda e baixar o estoque

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id         = intval($_POST['id']);
    $quantidade = intval($_POST['quantidade']);

    // Busca informações do produto
    $stmt = $pdo->prepare("SELECT estoque, valor_venda FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        die("❌ Erro: Produto não encontrado.");
    }

    if ($produto['estoque'] < $quantidade) {
        die("❌ Estoque insuficiente!\n\nDisponível: " . $produto['estoque'] . " unidades");
    }

    // Atualiza o estoque (baixa)
    $novo_estoque = $produto['estoque'] - $quantidade;
    
    $stmt = $pdo->prepare("UPDATE produtos SET estoque = ? WHERE id = ?");
    $stmt->execute([$novo_estoque, $id]);

    $total_venda = $quantidade * $produto['valor_venda'];

    echo "✅ Venda realizada com sucesso!\n\n";
    echo "Total da venda: R$ " . number_format($total_venda, 2, ',', '.');
}
?>
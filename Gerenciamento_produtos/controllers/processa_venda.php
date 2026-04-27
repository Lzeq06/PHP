<?php
require '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = intval($_POST['id']);
    $quantidade = intval($_POST['quantidade']);

    // Busca o produto
    $stmt = $pdo->prepare("SELECT id, descricao, estoque, valor_venda FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        die("❌ Produto não encontrado.");
    }

    if ($produto['estoque'] < $quantidade) {
        die("❌ Estoque insuficiente! Disponível: " . $produto['estoque']);
    }

    // Calcula o total
    $valor_total = $quantidade * $produto['valor_venda'];

    // Baixa o estoque
    $novo_estoque = $produto['estoque'] - $quantidade;
    $stmt = $pdo->prepare("UPDATE produtos SET estoque = ? WHERE id = ?");
    $stmt->execute([$novo_estoque, $id]);

    // ====================== REGISTRA NO HISTÓRICO ======================
    $stmt = $pdo->prepare("INSERT INTO vendas (produto_id, quantidade, valor_total) VALUES (?, ?, ?)");
    $stmt->execute([$id, $quantidade, $valor_total]);

    // Mensagem de sucesso
    echo "✅ Venda realizada com sucesso!\n\n";
    echo "Produto: " . $produto['descricao'] . "\n";
    echo "Quantidade: " . $quantidade . "\n";
    echo "Total: R$ " . number_format($valor_total, 2, ',', '.');
}
?>
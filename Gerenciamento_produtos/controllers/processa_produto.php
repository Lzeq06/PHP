<?php
require '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    // ====================== CADASTRO  ======================
    if ($acao === 'cadastrar') {
        $descricao = trim($_POST['descricao']);
        $categoria = $_POST['categoria'];
        $valor_compra = floatval($_POST['valor_compra']);
        $valor_venda = floatval($_POST['valor_venda']);
        $estoque = intval($_POST['estoque']);

        $stmt = $pdo->prepare("INSERT INTO produtos (descricao, categoria, valor_compra, valor_venda, estoque) 
                               VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$descricao, $categoria, $valor_compra, $valor_venda, $estoque]);

        echo "<script>alert('✅ Produto cadastrado com sucesso!'); window.location.href='../index.php';</script>";
    }

    // ====================== EDIÇÃO ======================
    elseif ($acao === 'editar') {
        $id = intval($_POST['id']);
        $descricao = trim($_POST['descricao']);
        $categoria = $_POST['categoria'];
        $valor_compra = floatval($_POST['valor_compra']);
        $valor_venda = floatval($_POST['valor_venda']);
        $estoque = intval($_POST['estoque']);

        $stmt = $pdo->prepare("UPDATE produtos SET 
            descricao = ?, 
            categoria = ?, 
            valor_compra = ?, 
            valor_venda = ?, 
            estoque = ? 
            WHERE id = ?");

        $stmt->execute([$descricao, $categoria, $valor_compra, $valor_venda, $estoque, $id]);

        echo "<script>alert('✅ Produto atualizado com sucesso!'); window.location.href='../index.php';</script>";
    }

    // ====================== EXCLUIR ======================
    elseif ($acao === 'excluir') {
        $id = intval($_POST['id']);
        $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        echo "ok";
    }
}

// ====================== BUSCAR PRODUTO PARA EDIÇÃO ======================
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['acao']) && $_GET['acao'] === 'get') {
    $id = intval($_GET['id']);

    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        header('Content-Type: application/json');
        echo json_encode($produto);
    } else {
        http_response_code(404);
        echo json_encode(['erro' => 'Produto não encontrado']);
    }
}
?>
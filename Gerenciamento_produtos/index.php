<?php
require 'includes/config.php';

$stmt = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Histórico de vendas
$stmtVendas = $pdo->query("SELECT v.*, p.descricao 
                           FROM vendas v 
                           JOIN produtos p ON v.produto_id = p.id 
                           ORDER BY v.data_venda DESC LIMIT 15");
$vendas = $stmtVendas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos - Lz</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container">

        <h2>📦 Cadastro de Produto - Lz</h2>
        <form id="formProduto" method="POST" action="controllers/processa_produto.php">
            <input type="hidden" name="id" id="edit_id">

            <div>
                <label>Descrição</label>
                <input type="text" name="descricao" id="form_descricao" required>
            </div>
            <div>
                <label>Categoria</label>
                <select name="categoria" id="form_categoria" required>
                    <option value="">Selecione...</option>
                    <option value="Informática">Informática</option>
                    <option value="Eletrônicos">Eletrônicos</option>
                    <option value="Periféricos">Periféricos</option>
                    <option value="Acessórios">Acessórios</option>
                </select>
            </div>
            <div>
                <label>Valor Compra (R$)</label>
                <input type="number" id="valor_compra" name="valor_compra" step="0.01" required>
            </div>
            <div>
                <label>Margem de Lucro (%)</label>
                <input type="number" id="margem" value="30" step="0.01">
                <button type="button" class="btn btn-warning" onclick="calcularPrecoVenda()"
                    style="margin-top: 10px; width:100%;">
                    CALCULAR PREÇO DE VENDA
                </button>
            </div>
            <div>
                <label>Valor Venda (R$)</label>
                <input type="number" id="valor_venda" name="valor_venda" step="0.01" required>
            </div>
            <div>
                <label>Quantidade em Estoque</label>
                <input type="number" name="estoque" id="form_estoque" value="0" min="0" required>
            </div>

            <div style="grid-column: span 2; display: flex; gap: 15px; margin-top: 15px;">
                <button type="submit" name="acao" value="cadastrar" id="btnSubmit" class="btn btn-primary">
                    CADASTRAR PRODUTO
                </button>
                <button type="button" onclick="venderProduto()" class="btn btn-success">
                    VENDER PRODUTO
                </button>
                <button type="button" onclick="cancelarEdicao()" class="btn btn-danger" id="btnCancelar"
                    style="display:none;">
                    CANCELAR EDIÇÃO
                </button>
            </div>
        </form>

        <h2>📋 Inventário</h2>
        <div class="search">
            <input type="text" id="filtro" placeholder="🔍 Pesquisar por ID, descrição ou categoria..."
                onkeyup="filtrarTabela()">
        </div>

        <table id="tabelaProdutos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Valor Venda</th>
                    <th>Lucro Unitário</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $p): ?>
                    <tr>
                        <td>
                            <?= $p['id'] ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($p['descricao']) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($p['categoria']) ?>
                        </td>
                        <td>R$
                            <?= number_format($p['valor_venda'], 2, ',', '.') ?>
                        </td>
                        <td>R$
                            <?= number_format($p['valor_venda'] - $p['valor_compra'], 2, ',', '.') ?>
                        </td>
                        <td>
                            <?= $p['estoque'] ?>
                        </td>
                        <td>
                            <button onclick="editarProduto(<?= $p['id'] ?>)" class="btn"
                                style="background:#f39c12; color:white; padding:6px 12px; margin-right:5px;">✏️
                                Editar</button>
                            <button onclick="excluirProduto(<?= $p['id'] ?>)" class="btn btn-danger">🗑 Excluir</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <hr style="margin: 40px 0;">
        <h2>🪙 Histórico de Vendas </h2>
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Produto</th>
                    <th>Qtd</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vendas as $v): ?>
                    <tr>
                        <td>
                            <?= date('d/m/Y H:i', strtotime($v['data_venda'])) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($v['descricao']) ?>
                        </td>
                        <td>
                            <?= $v['quantidade'] ?>
                        </td>
                        <td><strong>R$
                                <?= number_format($v['valor_total'], 2, ',', '.') ?>
                            </strong></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function calcularPrecoVenda() {
            const valorCompra = parseFloat(document.getElementById('valor_compra').value);
            const margem = parseFloat(document.getElementById('margem').value);
            if (!valorCompra || !margem) {
                alert("Preencha o Valor de Compra e a Margem de Lucro");
                return;
            }
            const valorVenda = valorCompra * (1 + (margem / 100));
            document.getElementById('valor_venda').value = valorVenda.toFixed(2);
        }

        function venderProduto() {
            const id = prompt("Digite o ID do produto:");
            if (!id) return;
            const qtd = parseInt(prompt("Quantidade a vender:"));
            if (!qtd || qtd <= 0) return;

            fetch('controllers/processa_venda.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${id}&quantidade=${qtd}`
            })
                .then(r => r.text())
                .then(msg => { alert(msg); location.reload(); });
        }

        function editarProduto(id) {
            fetch('controllers/processa_produto.php?acao=get&id=' + id)
                .then(r => r.json())
                .then(produto => {
                    document.getElementById('edit_id').value = produto.id;
                    document.getElementById('form_descricao').value = produto.descricao;
                    document.getElementById('form_categoria').value = produto.categoria;
                    document.getElementById('valor_compra').value = produto.valor_compra;
                    document.getElementById('valor_venda').value = produto.valor_venda;
                    document.getElementById('form_estoque').value = produto.estoque;

                    document.getElementById('btnSubmit').textContent = '💾 ATUALIZAR PRODUTO';
                    document.getElementById('btnSubmit').value = 'editar';
                    document.getElementById('btnCancelar').style.display = 'inline-block';
                });
        }

        function cancelarEdicao() {
            document.getElementById('formProduto').reset();
            document.getElementById('edit_id').value = '';
            document.getElementById('btnSubmit').textContent = 'CADASTRAR PRODUTO';
            document.getElementById('btnSubmit').value = 'cadastrar';
            document.getElementById('btnCancelar').style.display = 'none';
        }

        function excluirProduto(id) {
            if (confirm('Tem certeza que deseja excluir este produto?')) {
                fetch('controllers/processa_produto.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `acao=excluir&id=${id}`
                }).then(() => location.reload());
            }
        }

        function filtrarTabela() {
            const filtro = document.getElementById('filtro').value.toLowerCase().trim();
            const rows = document.querySelectorAll('#tabelaProdutos tbody tr');

            rows.forEach(row => {
                const id = row.cells[0].textContent.toLowerCase();           // Coluna ID
                const descricao = row.cells[1].textContent.toLowerCase();    // Descrição
                const categoria = row.cells[2].textContent.toLowerCase();    // Categoria

                // Se digitar só número, busca principalmente por ID
                if (/^\d+$/.test(filtro)) {
                    row.style.display = id.includes(filtro) ? '' : 'none';
                }
                // Senão busca em todos os campos
                else {
                    const textoCompleto = row.textContent.toLowerCase();
                    row.style.display = textoCompleto.includes(filtro) ? '' : 'none';
                }
            });
        }
    </script>
</body>

</html>
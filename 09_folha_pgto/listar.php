<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "folha_pgto";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão com o banco: " . $conn->connect_error);
}


$sql = "SELECT * FROM tb_funcionarios ORDER BY N_Registro ASC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demonstrativos de Pagamentos</title>
    <link rel="stylesheet" href="style-listar.css">
</head>

<body>

    <div class="container">
        <h1>DEMONSTRATIVOS DE PAGAMENTOS</h1>

        <table>
            <tr>
                <th>Nº REGISTRO</th>
                <th>NOME DO FUNCIONÁRIO</th>
                <th>DATA DE ADMISSÃO</th>
                <th>CARGO</th>
                <th>QTDE DE SALÁRIOS</th>
                <th>SALÁRIO BRUTO</th>
                <th>INSS</th>
                <th>SALÁRIO LÍQUIDO</th>
            </tr>

            <?php
            if ($resultado->num_rows > 0) {
                while ($linha = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $linha["N_Registro"] . "</td>";
                    echo "<td>" . $linha["Nome_Funcionario"] . "</td>";
                    echo "<td>" . date("d/m/Y", strtotime($linha["data_admissao"])) . "</td>";
                    echo "<td>" . $linha["cargo"] . "</td>";
                    echo "<td>" . number_format($linha["qtde_salarios"], 2, ',', '.') . "</td>";
                    echo "<td>R$ " . number_format($linha["salario_bruto"], 2, ',', '.') . "</td>";
                    echo "<td>R$ " . number_format($linha["inss"], 2, ',', '.') . "</td>";
                    echo "<td>R$ " . number_format($linha["salario_liquido"], 2, ',', '.') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td colspan='8'>Nenhum funcionário cadastrado.</td>";
                echo "</tr>";
            }
            ?>
        </table>

        <div class="botoes">
            <a href="index.php" class="btn_voltar">VOLTAR</a>
        </div>
    </div>

</body>

</html>
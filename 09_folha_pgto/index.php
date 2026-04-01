<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "folha_pgto";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão com o banco: " . $conn->connect_error);
}


$mensagem = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $n_registro = $_POST["n_registro"];
    $nome_funcionario = $_POST["nome_funcionario"];
    $data_admissao = $_POST["data_admissao"];
    $cargo = $_POST["cargo"];
    $qtde_salarios = $_POST["qtde_salarios"];


    $salario_minimo = 1621.00;
    $salario_bruto = $qtde_salarios * $salario_minimo;

    if ($salario_bruto <= 1621.00) {
        $aliquota = 0.075;
    } elseif ($salario_bruto <= 2902.84) {
        $aliquota = 0.09;
    } elseif ($salario_bruto <= 4354.27) {
        $aliquota = 0.12;
    } else {
        $aliquota = 0.14;
    }

    $inss = $salario_bruto * $aliquota;
    $salario_liquido = $salario_bruto - $inss;

    $sql = "INSERT INTO tb_funcionarios
    (N_Registro, Nome_Funcionario, data_admissao, cargo, qtde_salarios, salario_bruto, inss, salario_liquido)
    VALUES
    ('$n_registro', '$nome_funcionario', '$data_admissao', '$cargo', '$qtde_salarios', '$salario_bruto', '$inss', '$salario_liquido')";

    if ($conn->query($sql) === TRUE) {
        $mensagem = "Funcionário cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <title>Cadastro de Funcionários</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container">

        <h1>CADASTRO DE FUNCIONÁRIOS</h1>

        <fieldset>

            <legend>DADOS DO FUNCIONÁRIO</legend>

            <form method="POST">

                <div class="linha">

                    <div class="campo">
                        <label>Nº REGISTRO</label>
                        <input type="number" name="n_registro" required>
                    </div>

                </div>

                <div class="linha">

                    <div class="campo">
                        <label>NOME DO FUNCIONÁRIO</label>
                        <input type="text" name="nome_funcionario" required>
                    </div>

                    <div class="campo">
                        <label>DATA DE ADMISSÃO</label>
                        <input type="date" name="data_admissao" required>
                    </div>

                </div>

                <div class="linha">

                    <div class="campo">
                        <label>CARGO</label>

                        <select name="cargo" required>

                            <option value="">Selecione</option>
                            <option>Gerente</option>
                            <option>Supervisor</option>
                            <option>Analista</option>
                            <option>Assistente</option>
                            <option>Auxiliar</option>
                            <option>Estagiário</option>

                        </select>

                    </div>

                    <div class="campo">
                        <label>QTDE DE SALÁRIOS MÍNIMOS</label>
                        <input type="number" step="0.01" name="qtde_salarios" required>
                    </div>

                </div>

                <div class="botoes">

                    <button type="submit">CADASTRAR</button>

                    <a href="listar.php" class="btn_vis">VISUALIZAR DEMONSTRATIVOS DE PAGAMENTOS</a>

                </div>

            </form>

        </fieldset>

        <?php
        if ($mensagem != "") {
            echo "<p class='msg'>$mensagem</p>";
        }
        ?>

    </div>

</body>

</html>
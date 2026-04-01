<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 5 - Par ou Ímpar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding: 40px 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 480px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #495057;
        }

        input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 1.1rem;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1.1rem;
            cursor: pointer;
        }

        button:hover {
            background: #0069d9;
        }

        .resultado {
            margin-top: 30px;
            padding: 20px;
            background: #f1f3f5;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            text-align: center;
        }

        .resultado h2 {
            margin-bottom: 15px;
            color: #343a40;
        }

        .par {
            color: #28a745;
            font-weight: bold;
            font-size: 1.4rem;
        }

        .impar {
            color: #dc3545;
            font-weight: bold;
            font-size: 1.4rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Par ou Ímpar?</h1>

        <form method="post" action="">
            <label>Digite um número inteiro:</label>
            <input type="number" name="numero" step="1" required placeholder="Ex: 42">
            <button type="submit">Verificar</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $numero = filter_input(INPUT_POST, 'numero', FILTER_VALIDATE_INT);

            if ($numero === false || $numero === null) {
                echo '<div class="resultado"><p style="color:#dc3545;">Digite um número válido.</p></div>';
            } else {
                $tipo = ($numero % 2 === 0) ? 'PAR' : 'ÍMPAR';
                $classe = ($numero % 2 === 0) ? 'par' : 'impar';
                echo '<div class="resultado">';
                echo '<h2>Resultado</h2>';
                echo "<p>O número <strong>$numero</strong> é <span class='$classe'>$tipo</span>!</p>";
                echo '</div>';
            }
        }
        ?>

        <div class="voltar">
            <a href="../main_index.php"><br><br>
                <a href="../index.php"
                    style="display: block; text-align: center; color: #3498db; font-weight: bold; text-decoration: none; font-size: 1.1rem; margin: 20px 0;">
                    ← Voltar ao Menu Principal
                </a></a>
        </div>

    </div>
</body>

</html>
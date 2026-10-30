<?php
// Receber os dados do formulário
$peso = (float) str_replace(",", ".", $_GET["peso"] ?? "0");
$altura = (float) str_replace(",", ".", $_GET["altura"] ?? "0");

// Inicializar variáveis
$erro = "";
$imc = 0;
$imcFormatado = "";
$classe = "";

// Verificar se os valores são válidos
if ($peso <= 0 || $altura <= 0) {

    $erro = "Informe peso e altura maiores que zero.";

} else {

    // Calcular o IMC
    $imc = $peso / ($altura * $altura);

    // Formatar o resultado
    $imcFormatado = number_format($imc, 1, ",", ".");

    // Classificar o IMC
    if ($imc < 18.5) {
        $classe = "Abaixo do peso";

    } elseif ($imc < 25) {
        $classe = "Peso normal";

    } elseif ($imc < 30) {
        $classe = "Sobrepeso";

    } elseif ($imc < 35) {
        $classe = "Obesidade grau I";

    } elseif ($imc < 40) {
        $classe = "Obesidade grau II";

    } else {
        $classe = "Obesidade grau III";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC</title>
</head>

<body>

    <h1>Calculadora de IMC</h1>

    <form method="get">

        <p>
            <label for="peso">Peso (kg):</label>
            <input
                type="text"
                name="peso"
                id="peso"
                placeholder="Ex: 70"
                required
            >
        </p>

        <p>
            <label for="altura">Altura (m):</label>
            <input
                type="text"
                name="altura"
                id="altura"
                placeholder="Ex: 1.75"
                required
            >
        </p>

        <button type="submit">Calcular IMC</button>

    </form>

    <hr>

    <?php if ($erro): ?>

        <h2>Erro!</h2>
        <p><?= htmlspecialchars($erro) ?></p>

    <?php else: ?>

        <?php if (isset($_GET["peso"]) && isset($_GET["altura"])): ?>

            <h2>Resultado do cálculo</h2>

            <p>
                Peso:
                <strong><?= htmlspecialchars((string)$peso) ?> kg</strong>
            </p>

            <p>
                Altura:
                <strong><?= htmlspecialchars((string)$altura) ?> m</strong>
            </p>

            <p>
                Seu IMC é:
                <strong><?= $imcFormatado ?></strong>
            </p>

            <p>
                Classificação:
                <strong><?= htmlspecialchars($classe) ?></strong>
            </p>

            <p><em>O IMC é um indicador de triagem e não substitui uma avaliação profissional.</em></p>

        <?php endif; ?>

    <?php endif; ?>

</body>
</html>
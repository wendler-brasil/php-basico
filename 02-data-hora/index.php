
<?php

date_default_timezone_set("America/Sao_Paulo");


$data = date("d/m/Y");
$hora = date("H:i:s");


$mensagem = "Hoje é " . $data . " e agora são " . $hora . ".";


$mensagem2 = "Hoje é $data e agora são $hora.";


$horaAtual = (int) date("H");


if ($horaAtual < 12) {
    $saudacao = "Bom dia";
} elseif ($horaAtual < 18) {
    $saudacao = "Boa tarde";
} else {
    $saudacao = "Boa noite";
}


$diaSemana = date("w");

switch ($diaSemana) {
    case 0:
        $dia = "Domingo";
        break;
    case 1:
        $dia = "Segunda-feira";
        break;
    case 2:
        $dia = "Terça-feira";
        break;
    case 3:
        $dia = "Quarta-feira";
        break;
    case 4:
        $dia = "Quinta-feira";
        break;
    case 5:
        $dia = "Sexta-feira";
        break;
    case 6:
        $dia = "Sábado";
        break;
        default:
    $dia = "Dia desconhecido";
    break;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data e hora</title>
</head>

<body>

    <h1>Data e hora do servidor</h1>

    <h2><?= $saudacao ?>!</h2>

    <p>Hoje é <strong><?= $data ?></strong>.</p>

    <p>Dia da semana: <strong><?= $dia ?></strong>.</p>

    <p>Agora são <strong><?= $hora ?></strong>.</p>

    <h3>Mensagem com concatenação:</h3>
    <p><?= $mensagem ?></p>

    <h3>Mensagem com interpolação:</h3>
    <p><?= $mensagem2 ?></p>

    <h2>Relógio em tempo real</h2>
    <p id="relogio"></p>

    <script>
        function atualizarRelogio() {
            const agora = new Date();

            const horas = String(agora.getHours()).padStart(2, '0');
            const minutos = String(agora.getMinutes()).padStart(2, '0');
            const segundos = String(agora.getSeconds()).padStart(2, '0');

            document.getElementById("relogio").innerHTML =
                horas + ":" + minutos + ":" + segundos;
        }

        atualizarRelogio();

        setInterval(atualizarRelogio, 1000);
    </script>

</body>
</html>
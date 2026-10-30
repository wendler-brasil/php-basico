<?php
// Função para formatar preços
function formatarPreco(float $valor): string {
    return "R$ " . number_format($valor, 2, ",", ".");
}

// Lista de produtos
$produtos = [
    [
        "nome" => "Teclado mecânico",
        "preco" => 249.90,
        "estoque" => 12,
        "categoria" => "Informática"
    ],
    [
        "nome" => "Mouse sem fio",
        "preco" => 79.50,
        "estoque" => 30,
        "categoria" => "Informática"
    ],
    [
        "nome" => "Monitor LED",
        "preco" => 899.90,
        "estoque" => 5,
        "categoria" => "Monitores"
    ],
    [
        "nome" => "Fone de ouvido",
        "preco" => 129.90,
        "estoque" => 0,
        "categoria" => "Áudio"
    ],
    [
        "nome" => "Webcam HD",
        "preco" => 159.90,
        "estoque" => 0,
        "categoria" => "Acessórios"
    ],
];

// Ordenar produtos pelo menor preço
usort($produtos, function($a, $b) {
    return $a["preco"] <=> $b["preco"];
});

// Filtro de preço
$precoMinimo = 0;

// Calcular total em estoque
$total = 0;

foreach ($produtos as $item) {
    $estoque = $item["estoque"] ?? 0;
    $preco = $item["preco"] ?? 0;

    $total += $preco * $estoque;
}

// Contar produtos
$quantidade = count($produtos);

// Filtrar produtos
$produtosFiltrados = [];

foreach ($produtos as $item) {
    if ($item["preco"] > $precoMinimo) {
        $produtosFiltrados[] = $item;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lista de Produtos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th {
            background-color: #333;
            color: white;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #eee;
        }

        .esgotado {
            color: red;
            font-weight: bold;
        }

        .disponivel {
            color: green;
            font-weight: bold;
        }

        .resumo {
            margin-top: 20px;
            padding: 15px;
            background-color: white;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>

    <h1>Lista de Produtos</h1>

    <h2>Produtos cadastrados</h2>

    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Situação</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($produtosFiltrados as $item): ?>

                <tr>

                    <td>
                        <?= htmlspecialchars($item["nome"]) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($item["categoria"] ?? "Sem categoria") ?>
                    </td>

                    <td>
                        <?= formatarPreco($item["preco"]) ?>
                    </td>

                    <td>
                        <?= $item["estoque"] ?>
                    </td>

                    <td>
                        <?php if ($item["estoque"] > 0): ?>

                            <span class="disponivel">
                                Disponível
                            </span>

                        <?php else: ?>

                            <span class="esgotado">
                                Esgotado
                            </span>

                        <?php endif; ?>
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

    <div class="resumo">

        <h2>Resumo do estoque</h2>

        <p>
            Produtos cadastrados:
            <strong><?= $quantidade ?></strong>
        </p>

        <p>
            Valor total em estoque:
            <strong><?= formatarPreco($total) ?></strong>
        </p>

        <p>
            Produtos disponíveis:
            <strong>
                <?= count(array_filter($produtos, function($item) {
                    return $item["estoque"] > 0;
                })) ?>
            </strong>
        </p>

        <p>
            Produtos esgotados:
            <strong>
                <?= count(array_filter($produtos, function($item) {
                    return $item["estoque"] == 0;
                })) ?>
            </strong>
        </p>

    </div>

</body>
</html>
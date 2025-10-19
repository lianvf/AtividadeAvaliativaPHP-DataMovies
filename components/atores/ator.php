<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="components/atores/ator.css">
    <link rel="stylesheet" href="/components/card/card.css">
</head>

<body>
      <?php require_once __DIR__ . '/../nav-bar/nav-bar.php'; ?>
    <section class="ator-info">
        <div class="ator-fundo"></div>

        <div class="ator-quadro">
            <?php require_once __DIR__ . '/../quadro-info/quadro-info.php'; ?>
        </div>
    </section>

    <section class="card-section">
        <div class="section-titulo">
            <h2>FILMES DE "NOME DO ATOR"</h2>
        </div>
        <?php require_once __DIR__ . '/../card/card.php'; ?>
    </section>
</body>

</html>
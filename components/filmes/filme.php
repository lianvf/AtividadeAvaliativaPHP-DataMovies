<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="components/filmes/filme.css">
</head>

<body>
      <?php require_once __DIR__ . '/../nav-bar/nav-bar.php'; ?>
    <section class="filme-info">
        <div class="filme-fundo"></div>

        <div class="filme-quadro">
            <?php require_once __DIR__ . '/../quadro-info/quadro-info.php'; ?>
        </div>
    </section>

</body>

</html>
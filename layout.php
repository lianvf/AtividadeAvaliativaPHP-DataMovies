<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css"> 
    <title>DataMovies</title>
</head>
<body>

    <?php require_once __DIR__ . '/components/nav-bar/nav-bar.php'; ?>

    <main>
        <?php
            if (file_exists($pageToLoad)) {
                require $pageToLoad;
            } else {
                echo "<h1>Erro Crítico: Arquivo da rota não encontrado.</h1><p>Verificando: $pageToLoad</p>";
            }
        ?>
    </main>

</body>
</html>
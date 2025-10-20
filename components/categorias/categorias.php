<?php
require_once __DIR__ . '/../../config/database.php';

try {
    $conn = getConnection();

    $stmtCategorias = $conn->query("SELECT categoriaId as id, nome FROM categoria ORDER BY nome ASC");
    $categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);

    $stmtFilmes = $conn->query("
        SELECT 
            idFilme, 
            título as titulo,
            categoriaId,
            imagemUrl
        FROM filme
    ");
    $todosOsFilmes = $stmtFilmes->fetchAll(PDO::FETCH_ASSOC);

    $filmesPorCategoria = [];
    foreach ($todosOsFilmes as $filme) {
        $filmesPorCategoria[$filme['categoriaId']][] = $filme;
    }

} catch (PDOException $e) {
    die("Erro ao buscar dados: " . $e->getMessage());
}
?>

<link rel="stylesheet" href="/components/categorias/categorias.css">
<link rel="stylesheet" href="/components/card/card.css">

<div class="categorias-container">

    <?php foreach ($categorias as $categoria): ?>

        <section class="categoria-secao">

            <h2 class="categoria-titulo"><?= htmlspecialchars($categoria['nome']) ?></h2>

            <div class="categoria-linha">
                <?php
                $categoriaId = $categoria['id'];

                if (!empty($filmesPorCategoria[$categoriaId])) {

                    foreach ($filmesPorCategoria[$categoriaId] as $filme) {
                        $nome = htmlspecialchars($filme['titulo']);
                        $imagem = !empty($filme['imagemUrl'])
                            ? htmlspecialchars($filme['imagemUrl'])
                            : '/img/default_movie.png';

                        
                        echo '<a href="/filme?id=' . $filme['idFilme'] . '" class="card-link">';
                            require __DIR__ . '/../card/card.php';
                        echo '</a>';
                    }

                } else {
                    echo '<p class="mensagem-vazia">Nenhum filme encontrado nesta categoria.</p>';
                }
                ?>
            </div>

        </section>

    <?php endforeach; ?>

</div>
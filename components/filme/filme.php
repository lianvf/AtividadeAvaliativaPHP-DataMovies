<?php
$filmeId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$filmeId) {
    http_response_code(404);
    require __DIR__ . '/../../404.php';
    exit();
}

require_once __DIR__ . '/../../config/database.php';

try {
    $conn = getConnection();
    
    $stmtFilme = $conn->prepare("
        SELECT f.*, c.nome AS categoriaNome, i.nome AS idiomaNome
        FROM filme f
        LEFT JOIN categoria c ON f.categoriaId = c.categoriaId
        LEFT JOIN idioma i ON f.idiomaId = i.idiomaId
        WHERE f.idFilme = :id
    ");
    $stmtFilme->execute(['id' => $filmeId]);
    $filme = $stmtFilme->fetch(PDO::FETCH_ASSOC);

    if (!$filme) {
        http_response_code(404);
        require __DIR__ . '/../../404.php';
        exit();
    }

    $stmtAtores = $conn->prepare("
        SELECT a.idAtor, a.nome, a.sobrenome, a.imagemUrl
        FROM ator a
        JOIN ator_filme af ON a.idAtor = af.atorId
        WHERE af.filmeId = :id
    ");
    $stmtAtores->execute(['id' => $filmeId]);
    $atoresDoFilme = $stmtAtores->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro ao buscar dados do filme: " . $e->getMessage());
}
?>

<link rel="stylesheet" href="/components/filme/filme.css">
<link rel="stylesheet" href="/components/card/card.css">

<section class="filme-info">
    <div class="filme-fundo" style="background-image: url('<?= htmlspecialchars($filme['imagemUrl'] ?? '/img/default_movie.png') ?>');"></div>

    <div class="filme-quadro">
        <div class="quadro-info-container">
            <h1><?= htmlspecialchars($filme['título']) ?></h1>
            <div class="detalhes">
                <span><?= date('Y', strtotime($filme['anoLancamento'])) ?></span>
                <span><?= htmlspecialchars($filme['categoriaNome']) ?></span>
                <span><?= htmlspecialchars($filme['idiomaNome']) ?></span>
            </div>
        </div>
    </div>
</section>

<section class="elenco-container">
    <h2>Elenco</h2>
    <div class="elenco-lista">
        <?php if (!empty($atoresDoFilme)): ?>
            <?php foreach ($atoresDoFilme as $ator): ?>
                <?php
                    $nome = htmlspecialchars($ator['nome'] . ' ' . $ator['sobrenome']);
                    $imagem = !empty($ator['imagemUrl']) ? htmlspecialchars($ator['imagemUrl']) : '/img/default_avatar.png';
                    
                    echo '<a href="/ator?id=' . $ator['idAtor'] . '" class="card-link">';
                        require __DIR__ . '/../card/card.php';
                    echo '</a>';
                ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="mensagem-vazia">Nenhum ator cadastrado para este filme.</p>
        <?php endif; ?>
    </div>
</section>
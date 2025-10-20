<?php
$atorId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$atorId) {
    http_response_code(404);
    require __DIR__ . '/../../404.php';
    exit();
}

require_once __DIR__ . '/../../models/Ator.php';

try {
    $atorModel = new Ator();
    
    $ator = $atorModel->read($atorId);

    if (!$ator) {
        http_response_code(404);
        require __DIR__ . '/../../404.php';
        exit();
    }

    $filmesDoAtor = $atorModel->getFilmes($atorId);

} catch (PDOException $e) {
    die("Erro ao buscar dados do ator: " . $e->getMessage());
}
?>

<link rel="stylesheet" href="/components/ator/ator.css">
<link rel="stylesheet" href="/components/card/card.css">

<section class="ator-info">
    <div class="ator-fundo" style="background-image: url('<?= htmlspecialchars($ator['imagemUrl'] ?? '/img/default_avatar.png') ?>');"></div>

    <div class="ator-quadro">
        <div class="quadro-info-container">
            <h1><?= htmlspecialchars($ator['nome'] . ' ' . $ator['sobrenome']) ?></h1>
            <div class="detalhes">
                <span><?= htmlspecialchars($ator['nacionalidade']) ?></span>
                <?php if (!empty($ator['dataNasc'])): ?>
                    <span><?= date('Y') - date('Y', strtotime($ator['dataNasc'])) ?> anos</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="filmografia-container">
    <h2>Filmografia</h2>
    <div class="filmografia-lista">
        <?php if (!empty($filmesDoAtor)): ?>
            <?php foreach ($filmesDoAtor as $filme): ?>
                <?php
                    $nome = htmlspecialchars($filme['título']);
                    $imagem = !empty($filme['imagemUrl']) ? htmlspecialchars($filme['imagemUrl']) : '/img/default_movie.png';
                    
                    echo '<a href="/filme?id=' . $filme['idFilme'] . '" class="card-link">';
                        require __DIR__ . '/../card/card.php';
                    echo '</a>';
                ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="mensagem-vazia">Nenhum filme cadastrado para este ator.</p>
        <?php endif; ?>
    </div>
</section>
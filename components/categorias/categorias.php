<?php
$categorias = [
    ['id' => 1, 'nome' => 'Ação e Aventura'],
    ['id' => 2, 'nome' => 'Ficção Científica'],
    ['id' => 3, 'nome' => 'Comédia'],
];

$filmes = [
    ['titulo' => 'Missão Impossível', 'imagem' => '/img/filmes/acao1.jpg', 'categoriaId' => 1],
    ['titulo' => '007', 'imagem' => '/img/filmes/acao4.jpg', 'categoriaId' => 1],
    ['titulo' => 'Blade Runner 2049', 'imagem' => '/img/filmes/scifi1.jpg', 'categoriaId' => 2],
    ['titulo' => 'Duna', 'imagem' => '/img/filmes/scifi2.jpg', 'categoriaId' => 2],
    ['titulo' => 'Interestelar', 'imagem' => '/img/filmes/scifi3.jpg', 'categoriaId' => 2],
    ['titulo' => 'Gente Grande', 'imagem' => '/img/filmes/comedia3.jpg', 'categoriaId' => 3],
];
?>

<link rel="stylesheet" href="/components/categorias/categorias.css">
<link rel="stylesheet" href="/components/card/card.css">

<div class="categorias-container">

    <?php foreach ($categorias as $categoria): ?>
        
        <section class="categoria-secao">
            
            <h2 class="categoria-titulo"><?= htmlspecialchars($categoria['nome']) ?></h2>
            
            <div class="categoria-linha">
                <?php
                foreach ($filmes as $filme) {
                    if ($filme['categoriaId'] == $categoria['id']) {
                        $nome = $filme['titulo'];
                        $imagem = $filme['imagem'];
                        
                        require __DIR__ . '/../card/card.php';
                    }
                }
                ?>
            </div>
            
        </section>

    <?php endforeach; ?>

</div>
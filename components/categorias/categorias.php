<?php
require_once __DIR__ . '/../../config/database.php';

try {
    $conn = getConnection();
    
    // Buscar todas as categorias
    $stmt = $conn->query("SELECT categoriaId as id, nome FROM categoria");
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Buscar todos os filmes com suas categorias
    $stmt = $conn->query("
        SELECT 
            f.idFilme,
            f.título as titulo,
            f.categoriaId,
            COALESCE(CONCAT('/img/', f.título, '.jpg'), '/img/default-movie.jpg') as imagem
        FROM filme f
    ");
    $filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
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
                foreach ($filmes as $filme) {
                    if ($filme['categoriaId'] == $categoria['id']) {
                        $nome = htmlspecialchars($filme['titulo']);
                        $imagem = file_exists(substr($filme['imagem'], 1)) ? $filme['imagem'] : '/img/jumanjiposter.png';
                        
                        require __DIR__ . '/../card/card.php';
                    }
                }
                ?>
            </div>
            
        </section>

    <?php endforeach; ?>

</div>
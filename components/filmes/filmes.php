<?php
require_once __DIR__ . '/../../config/database.php';

try {
    $conn = getConnection();
    
    $stmt = $conn->query("
        SELECT idFilme, título, imagemUrl 
        FROM filme 
        ORDER BY título ASC
    ");
    
    $filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro ao buscar filmes: " . $e->getMessage());
}
?>

<link rel="stylesheet" href="/components/filmes/filmes.css">
<link rel="stylesheet" href="/components/card/card.css">

<div class="filmes-container">
    <div class="filmes-titulo">
        <h1>FILMES</h1>
    </div>

    <div class="filmes-lista">
        <?php
        foreach ($filmes as $filme) {
            
            $nome = htmlspecialchars($filme['título']);
            
            $imagem = !empty($filme['imagemUrl']) 
                ? htmlspecialchars($filme['imagemUrl']) 
                : '/img/default_movie.png'; 

            echo '<a href="/filme?id=' . $filme['idFilme'] . '" class="card-link">';
                require __DIR__ . '/../card/card.php';
            echo '</a>';
        }
        ?>
    </div>
</div>
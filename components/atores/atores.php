<?php
require_once __DIR__ . '/../../config/database.php';

try {
    $conn = getConnection();
    
   $stmt = $conn->query("
        SELECT idAtor, nome, sobrenome, imagemUrl 
        FROM ator 
        ORDER BY nome ASC
    "); 
    
    $atores = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro ao buscar atores: " . $e->getMessage());
}
?>

<link rel="stylesheet" href="/components/atores/atores.css">
<link rel="stylesheet" href="/components/card/card.css">

<div class="atores-container">
    <div class="atores-titulo">
        <h1>ATORES</h1>
    </div>

    <div class="atores-lista">
        <?php
        foreach ($atores as $ator) {
            
            $nome = htmlspecialchars($ator['nome'] . ' ' . $ator['sobrenome']);
            
            
            $imagem = !empty($ator['imagemUrl']) 
                ? htmlspecialchars($ator['imagemUrl']) 
                : '/img/default_avatar.png'; 

            echo '<a href="/ator?id=' . $ator['idAtor'] . '" class="card-link">';
                require __DIR__ . '/../card/card.php';
            echo '</a>';
        }
        ?>
    </div>
</div>
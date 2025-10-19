<?php
require_once __DIR__ . '/config/database.php';

try {
    $conn = getConnection();

    // Desabilitar verificação de chaves estrangeiras
    $conn->exec("SET FOREIGN_KEY_CHECKS = 0");

    // Limpar todas as tabelas
    $conn->exec("TRUNCATE TABLE ator_filme");
    $conn->exec("TRUNCATE TABLE filme");
    $conn->exec("TRUNCATE TABLE ator");
    $conn->exec("TRUNCATE TABLE categoria");
    $conn->exec("TRUNCATE TABLE classificacaoindicativa");
    $conn->exec("TRUNCATE TABLE nacionalidade");
    $conn->exec("TRUNCATE TABLE idioma");

    // Habilitar verificação de chaves estrangeiras novamente
    $conn->exec("SET FOREIGN_KEY_CHECKS = 1");

    // Inserir idiomas
    $sql = "INSERT INTO idioma (idiomaId, nome) VALUES 
            (1, 'Português'),
            (2, 'Inglês'),
            (3, 'Espanhol')";
    $conn->exec($sql);

    // Inserir nacionalidades
    $sql = "INSERT INTO nacionalidade (nacionalidadeId, pais, nome, idiomaId) VALUES 
            (1, 'Brasil', 'Brasileiro', 1),
            (2, 'Estados Unidos', 'Americano', 2),
            (3, 'Inglaterra', 'Inglês', 2)";
    $conn->exec($sql);

    // Inserir categorias
    $sql = "INSERT INTO categoria (categoriaId, nome) VALUES 
            (1, 'Ação'),
            (2, 'Comédia'),
            (3, 'Drama'),
            (4, 'Ficção Científica')";
    $conn->exec($sql);

    // Inserir classificação indicativa
    $sql = "INSERT INTO classificacaoindicativa (classificacaoIndicativaId, descricao) VALUES 
            (1, 'Livre'),
            (2, '12 anos'),
            (3, '14 anos'),
            (4, '16 anos'),
            (5, '18 anos')";
    $conn->exec($sql);

    // Inserir filmes
    $sql = "INSERT INTO filme (idFilme, título, anoLancamento, categoriaId, idiomaId, classificacaoIndicativaId, nacionalidadeId) VALUES 
            (1, 'Jumanji', '2017-01-01', 1, 2, 2, 2),
            (2, 'Matrix', '1999-01-01', 4, 2, 4, 2),
            (3, 'O Poderoso Chefão', '1972-01-01', 3, 2, 5, 2),
            (4, 'Se Beber, Não Case!', '2009-01-01', 2, 2, 4, 2)";
    $conn->exec($sql);

    // Inserir atores
    $sql = "INSERT INTO ator (idAtor, nome, sobrenome, nacionalidadeId, dataNasc, sexo) VALUES 
            (1, 'Dwayne', 'Johnson', 2, '1972-05-02', 'M'),
            (2, 'Keanu', 'Reeves', 2, '1964-09-02', 'M'),
            (3, 'Marlon', 'Brando', 2, '1924-04-03', 'M'),
            (4, 'Bradley', 'Cooper', 2, '1975-01-05', 'M')";
    $conn->exec($sql);

    // Inserir relação ator-filme
    $sql = "INSERT INTO ator_filme (atorId, filmeId) VALUES 
            (1, 1),
            (2, 2),
            (3, 3),
            (4, 4)";
    $conn->exec($sql);

    echo "Dados inseridos com sucesso!";

} catch(PDOException $e) {
    echo "Erro ao inserir dados: " . $e->getMessage();
} finally {
    // Garantir que a verificação de chaves estrangeiras seja reativada
    if (isset($conn)) {
        $conn->exec("SET FOREIGN_KEY_CHECKS = 1");
    }
}
?>
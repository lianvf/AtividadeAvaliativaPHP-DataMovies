<?php
require_once __DIR__ . '/../config/database.php';

class Filme {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    public function create($titulo, $anoLancamento, $categoriaId, $idiomaId, $classificacaoIndicativaId, $nacionalidadeId, $imagemUrl) {
        try {
            $sql = "INSERT INTO filme (título, anoLancamento, categoriaId, idiomaId, classificacaoIndicativaId, nacionalidadeId, imagemUrl) 
                    VALUES (:titulo, :anoLancamento, :categoriaId, :idiomaId, :classificacaoIndicativaId, :nacionalidadeId, :imagemUrl)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':anoLancamento', $anoLancamento);
            $stmt->bindParam(':categoriaId', $categoriaId);
            $stmt->bindParam(':idiomaId', $idiomaId);
            $stmt->bindParam(':classificacaoIndicativaId', $classificacaoIndicativaId);
            $stmt->bindParam(':nacionalidadeId', $nacionalidadeId);
            $stmt->bindParam(':imagemUrl', $imagemUrl);
            return $stmt->execute();
        } catch(PDOException $e) {
            die("Error creating movie: " . $e->getMessage());
        }
    }

    public function read($id = null) {
        try {
            if ($id) {
                $sql = "SELECT f.*, c.nome as categoria, i.nome as idioma, ci.classificacao, n.nome as nacionalidade 
                        FROM filme f 
                        JOIN categoria c ON f.categoriaId = c.categoriaId 
                        JOIN idioma i ON f.idiomaId = i.idiomaId 
                        JOIN classificacaoindicativa ci ON f.classificacaoIndicativaId = ci.classificacaoIndicativaId 
                        LEFT JOIN nacionalidade n ON f.nacionalidadeId = n.nacionalidadeId 
                        WHERE f.idFilme = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $sql = "SELECT f.*, c.nome as categoria, i.nome as idioma, ci.classificacao, n.nome as nacionalidade 
                        FROM filme f 
                        JOIN categoria c ON f.categoriaId = c.categoriaId 
                        JOIN idioma i ON f.idiomaId = i.idiomaId 
                        JOIN classificacaoindicativa ci ON f.classificacaoIndicativaId = ci.classificacaoIndicativaId 
                        LEFT JOIN nacionalidade n ON f.nacionalidadeId = n.nacionalidadeId";
                $stmt = $this->conn->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch(PDOException $e) {
            die("Error reading movie: " . $e->getMessage());
        }
    }

    public function update($id, $titulo, $anoLancamento, $categoriaId, $idiomaId, $classificacaoIndicativaId, $nacionalidadeId, $imagemUrl) {
        try {
            $sql = "UPDATE filme 
                    SET título = :titulo, 
                        anoLancamento = :anoLancamento, 
                        categoriaId = :categoriaId, 
                        idiomaId = :idiomaId, 
                        classificacaoIndicativaId = :classificacaoIndicativaId, 
                        nacionalidadeId = :nacionalidadeId,
                        imagemUrl = :imagemUrl
                    WHERE idFilme = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':anoLancamento', $anoLancamento);
            $stmt->bindParam(':categoriaId', $categoriaId);
            $stmt->bindParam(':idiomaId', $idiomaId);
            $stmt->bindParam(':classificacaoIndicativaId', $classificacaoIndicativaId);
            $stmt->bindParam(':nacionalidadeId', $nacionalidadeId);
            $stmt->bindParam(':imagemUrl', $imagemUrl);
            return $stmt->execute();
        } catch(PDOException $e) {
            die("Error updating movie: " . $e->getMessage());
        }
    }

    public function delete($id) {
    try {
        $sql = "DELETE FROM ator_filme WHERE filmeId = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $sql = "DELETE FROM filme WHERE idFilme = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch(PDOException $e) {
        die("Error deleting movie: " . $e->getMessage());
    }
}

    
    public function getAtores($filmeId) {
        try {
            $sql = "SELECT a.* FROM ator a 
                    JOIN ator_filme af ON a.idAtor = af.atorId 
                    WHERE af.filmeId = :filmeId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':filmeId', $filmeId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die("Error getting movie's actors: " . $e->getMessage());
        }
    }

    public function addAtor($filmeId, $atorId) {
        try {
            $sql = "INSERT INTO ator_filme (filmeId, atorId) VALUES (:filmeId, :atorId)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':filmeId', $filmeId);
            $stmt->bindParam(':atorId', $atorId);
            return $stmt->execute();
        } catch(PDOException $e) {
            die("Error adding actor to movie: " . $e->getMessage());
        }
    }

    public function removeAtor($filmeId, $atorId) {
        try {
            $sql = "DELETE FROM ator_filme WHERE filmeId = :filmeId AND atorId = :atorId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':filmeId', $filmeId);
            $stmt->bindParam(':atorId', $atorId);
            return $stmt->execute();
        } catch(PDOException $e) {
            die("Error removing actor from movie: " . $e->getMessage());
        }
    }
}
?>
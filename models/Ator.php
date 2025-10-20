<?php
require_once __DIR__ . '/../config/database.php';

class Ator {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    public function create($nome, $sobrenome, $nacionalidadeId, $dataNasc, $sexo, $imagemUrl = null) {
        try {
            $sql = "INSERT INTO ator (nome, sobrenome, nacionalidadeId, dataNasc, sexo, imagemUrl) 
                    VALUES (:nome, :sobrenome, :nacionalidadeId, :dataNasc, :sexo, :imagemUrl)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sobrenome', $sobrenome);
            $stmt->bindParam(':nacionalidadeId', $nacionalidadeId);
            $stmt->bindParam(':dataNasc', $dataNasc);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':imagemUrl', $imagemUrl); 
            return $stmt->execute();
        } catch(PDOException $e) {
            die("Error creating actor: " . $e->getMessage());
        }
    }

    public function read($id = null) {
        try {
            if ($id) {
                $sql = "SELECT a.*, n.nome as nacionalidade 
                        FROM ator a 
                        JOIN nacionalidade n ON a.nacionalidadeId = n.nacionalidadeId 
                        WHERE a.idAtor = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $sql = "SELECT a.*, n.nome as nacionalidade 
                        FROM ator a 
                        JOIN nacionalidade n ON a.nacionalidadeId = n.nacionalidadeId";
                $stmt = $this->conn->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch(PDOException $e) {
            die("Error reading actor: " . $e->getMessage());
        }
    }

    public function update($id, $nome, $sobrenome, $nacionalidadeId, $dataNasc, $sexo, $imagemUrl = null) {
        try {
            $sql = "UPDATE ator 
                    SET nome = :nome, 
                        sobrenome = :sobrenome, 
                        nacionalidadeId = :nacionalidadeId, 
                        dataNasc = :dataNasc, 
                        sexo = :sexo,
                        imagemUrl = :imagemUrl
                    WHERE idAtor = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sobrenome', $sobrenome);
            $stmt->bindParam(':nacionalidadeId', $nacionalidadeId);
            $stmt->bindParam(':dataNasc', $dataNasc);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':imagemUrl', $imagemUrl); 
            return $stmt->execute();
        } catch(PDOException $e) {
            die("Error updating actor: " . $e->getMessage());
        }
    }

  public function delete($id) {
        try {
            $sql = "DELETE FROM ator_filme WHERE atorId = :id"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $sql = "DELETE FROM ator WHERE idAtor = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch(PDOException $e) {
            die("Error deleting actor: " . $e->getMessage());
        }
    }

   public function getFilmes($atorId) {
    try {
        $sql = "SELECT f.idFilme, f.título, f.imagemUrl 
                FROM filme f 
                JOIN ator_filme af ON f.idFilme = af.filmeId 
                WHERE af.atorId = :atorId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':atorId', $atorId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        die("Error getting actor's movies: " . $e->getMessage());
    }
}
}
?>
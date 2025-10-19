<?php
require_once __DIR__ . '/../config/database.php';

class Nacionalidade {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    public function create($pais, $nome, $idiomaId) {
        try {
            $sql = "INSERT INTO nacionalidade (pais, nome, idiomaId) VALUES (:pais, :nome, :idiomaId)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':pais', $pais);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':idiomaId', $idiomaId);
            return $stmt->execute();
        } catch(PDOException $e) {
            die("Error creating nationality: " . $e->getMessage());
        }
    }

    public function read($id = null) {
        try {
            if ($id) {
                $sql = "SELECT * FROM nacionalidade WHERE nacionalidadeId = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $sql = "SELECT * FROM nacionalidade";
                $stmt = $this->conn->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch(PDOException $e) {
            die("Error reading nationality: " . $e->getMessage());
        }
    }

    public function update($id, $pais, $nome, $idiomaId) {
        try {
            $sql = "UPDATE nacionalidade SET pais = :pais, nome = :nome, idiomaId = :idiomaId WHERE nacionalidadeId = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':pais', $pais);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':idiomaId', $idiomaId);
            return $stmt->execute();
        } catch(PDOException $e) {
            die("Error updating nationality: " . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM nacionalidade WHERE nacionalidadeId = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch(PDOException $e) {
            die("Error deleting nationality: " . $e->getMessage());
        }
    }
}
?>
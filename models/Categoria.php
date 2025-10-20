<?php
require_once __DIR__ . '/../config/database.php';

class Categoria {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    public function create($nome) {
        $stmt = $this->conn->prepare("INSERT INTO categoria (nome) VALUES (:nome)");
        return $stmt->execute(['nome' => $nome]);
    }

    public function update($id, $nome) {
        $stmt = $this->conn->prepare("UPDATE categoria SET nome = :nome WHERE categoriaId = :id");
        return $stmt->execute(['nome' => $nome, 'id' => $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM categoria WHERE categoriaId = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
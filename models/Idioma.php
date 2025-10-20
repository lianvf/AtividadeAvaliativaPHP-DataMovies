<?php
require_once __DIR__ . '/../config/database.php';

class Idioma {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }
    
    public function create($nome) {
        $stmt = $this->conn->prepare("INSERT INTO idioma (nome) VALUES (:nome)");
        return $stmt->execute(['nome' => $nome]);
    }

    public function update($id, $nome) {
        $stmt = $this->conn->prepare("UPDATE idioma SET nome = :nome WHERE idiomaId = :id");
        return $stmt->execute(['nome' => $nome, 'id' => $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM idioma WHERE idiomaId = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
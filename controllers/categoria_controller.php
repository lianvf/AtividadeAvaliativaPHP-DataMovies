<?php
require_once __DIR__ . '/../models/Categoria.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoriaModel = new Categoria();
    
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'create':
            $categoriaModel->create($_POST['nome']);
            break;

        case 'update':
            $categoriaModel->update($_POST['categoriaId'], $_POST['nome']);
            break;
            
        case 'delete':
            $categoriaModel->delete($_POST['categoriaId']);
            break;
    }
}

header('Location: /gerenciamento');
exit();
?>
<?php
require_once __DIR__ . '/../models/Idioma.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idiomaModel = new Idioma();
    
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'create':
            $idiomaModel->create($_POST['nome']);
            break;

        case 'update':
            $idiomaModel->update($_POST['idiomaId'], $_POST['nome']);
            break;
            
        case 'delete':
            $idiomaModel->delete($_POST['idiomaId']);
            break;
    }
}

header('Location: /gerenciamento');
exit();
?>
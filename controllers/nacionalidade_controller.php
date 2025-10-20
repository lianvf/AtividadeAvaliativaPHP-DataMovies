<?php
require_once __DIR__ . '/../models/Nacionalidade.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nacionalidadeModel = new Nacionalidade();
    
    $action = $_POST['action'] ?? '';

    $idiomaId = $_POST['idiomaId'] ?? null;

    switch ($action) {
        case 'create':
            $nacionalidadeModel->create(
                $_POST['pais'],
                $_POST['nome'],
                $idiomaId
            );
            break;

        case 'update':
            $nacionalidadeModel->update(
                $_POST['nacionalidadeId'],
                $_POST['pais'],
                $_POST['nome'],
                $idiomaId
            );
            break;
            
        case 'delete':
            $nacionalidadeModel->delete($_POST['nacionalidadeId']);
            break;
    }
}

header('Location: /gerenciamento');
exit();
?>
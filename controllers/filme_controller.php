<?php
require_once __DIR__ . '/../models/Filme.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filmeModel = new Filme();
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'create':
            $filmeModel->create(
                $_POST['título'],
                $_POST['anoLancamento'],
                $_POST['categoriaId'],
                $_POST['idiomaId'],
                $_POST['classificacaoIndicativaId'],
                $_POST['nacionalidadeId'],
                $_POST['imagemUrl']
            );
            break;
        case 'update':
            $filmeModel->update(
                $_POST['idFilme'],
                $_POST['título'],
                $_POST['anoLancamento'],
                $_POST['categoriaId'],
                $_POST['idiomaId'],
                $_POST['classificacaoIndicativaId'],
                $_POST['nacionalidadeId'],
                $_POST['imagemUrl']
            );
            break;
        case 'delete':
            $filmeModel->delete($_POST['idFilme']);
            break;
    }
}

header('Location: /gerenciamento');
exit();
?>
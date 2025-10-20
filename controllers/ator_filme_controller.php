<?php
require_once __DIR__ . '/../models/Filme.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filmeModel = new Filme();
    $action = $_POST['action'] ?? '';

    $filmeId = $_POST['filmeId'] ?? null;
    $atorId = $_POST['atorId'] ?? null;

    if ($filmeId && $atorId) {
        switch ($action) {
            case 'add':
                $filmeModel->addAtor($filmeId, $atorId);
                break;
            case 'remove':
                $filmeModel->removeAtor($filmeId, $atorId);
                break;
        }
    }
}

header('Location: /gerenciamento#gerenciar-elenco');
exit();
?>
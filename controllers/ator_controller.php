<?php
require_once __DIR__ . '/../models/Ator.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $atorModel = new Ator();
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'create':
            $atorModel->create(
                $_POST['nome'], 
                $_POST['sobrenome'], 
                $_POST['nacionalidadeId'], 
                $_POST['dataNasc'], 
                $_POST['sexo'],
                $_POST['imagemUrl'] 
            );
            break;
        case 'update':
            $atorModel->update(
                $_POST['idAtor'], 
                $_POST['nome'], 
                $_POST['sobrenome'], 
                $_POST['nacionalidadeId'], 
                $_POST['dataNasc'], 
                $_POST['sexo'],
                $_POST['imagemUrl'] 
            );
            break;
        case 'delete':
            $atorModel->delete($_POST['idAtor']);
            break;
    }
}
header('Location: /gerenciamento');
exit();
?>